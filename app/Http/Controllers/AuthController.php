<?php

namespace App\Http\Controllers;

use App\Events\ForgetPassword;
use App\Events\RegisterCompleted;
use App\Http\Requests\AuthFogetPassRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\CustomerChangePassRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('google_id', $google_user->getId())
                ->orWhere('email', $google_user->getEmail())
                ->first();

            if ($user) {
                $user->update([
                    'name' => $google_user->getName(),
                    'google_token' => $google_user->token,
                    'google_refresh_token' => $google_user->refreshToken,
                ]);
            } else {
                $user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'password' => bcrypt('password'),
                    'google_id' => $google_user->getId(),
                    'google_token' => $google_user->token,
                    'google_refresh_token' => $google_user->refreshToken,
                ]);
            }

            Auth::login($user);

            return redirect()->route('client.index');
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('login')->withErrors('Something went wrong.');
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(AuthRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            RegisterCompleted::dispatch(["username" => $request->name, "email" => $request->email]);
            Log::channel('customer')->info($user->name . " đã đăng ký tài khoản");
        }

        Auth::login($user);

        return redirect()->route('client.index');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(AuthLoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $user = Auth::user();

            if ($user->active_status == 0) {
                Log::channel('customer')->info($user->name . " đã đăng nhập thành công");

                if ($user->role == 'admin') {
                    return redirect()->route('admin.index');
                }

                return redirect()->route('client.index');
            } else {
                Log::channel('customer')->warning($user->name . " không thể đăng nhập vì tài khoản không hoạt động.");
            }
        }
        return redirect()->back()->withErrors([
            'email' => 'Thông tin xác thực được cung cấp không khớp với hồ sơ của chúng tôi.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgetPassword()
    {
        return view("auth.reset");
    }

    public function forgetPasswordPost(AuthFogetPassRequest $request)
    {
        $token = Str::random(64);

        PasswordReset::create(
            [
                "email" => $request->email,
                "token" => $token,
                "created_at" => Carbon::now(),
                "expires_at" => Carbon::now()->addMinutes(5),
            ]
        );

        ForgetPassword::dispatch(['token' => $token, 'email' => $request->email]);

        return back()->with("success", "Bạn hãy kiểm tra email của mình");
    }

    public function resetPassword($token, $email)
    {
        return view("auth.new-password", compact("token", "email"));
    }

    public function resetPasswordPost(AuthFogetPassRequest $request)
    {
        $password_reset = PasswordReset::where(
            [
                "email" => $request->email,
                "token" => $request->token,
            ]
        )->first();

        if (!$password_reset) {
            return back()->with("error", "Đã có lỗi xảy ra");
        }

        if (Carbon::now()->greaterThan($password_reset->expires_at)) {
            return back()->with("error", "Đã hết thời gian bạn hãy gửi lại yêu cầu 1 lần nữa");
        }

        $pass_hash = bcrypt($request->password);

        User::where("email", $request->email)->update(["password" => $pass_hash]);

        PasswordReset::where("email", $request->email)->delete();

        return redirect()->route("login")->with("success", "Cập nhật mật khẩu thành công, hãy đăng nhập");
    }

    public function showChangePassForm()
    {
        return view("client.customer.change-pass");
    }

    public function ChangePassword(CustomerChangePassRequest $request)
    {
        $user = User::where("id", Auth::id())->first();

        $user->update(
            [
                "password" => bcrypt($request->new_password)
            ]
        );

        Log::channel('customer')->info($user->name . " đã đổi mật khẩu thành công");

        return redirect()->back()->with("change_success", "Mật khẩu đã được thay đổi");
    }
}
