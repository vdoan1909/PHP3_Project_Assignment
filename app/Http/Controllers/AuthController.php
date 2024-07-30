<?php

namespace App\Http\Controllers;

use App\Events\ForgetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('client.index');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.index');
            }

            return redirect()->route('client.index');
        }
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
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

    public function forgetPasswordPost(Request $request)
    {
        $request->validate(
            [
                "email" => "required|email|exists:users",
            ]
        );

        $token = Str::random(64);

        PasswordReset::create(
            [
                "email" => $request->email,
                "token" => $token,
                "created_at" => Carbon::now()
            ]
        );

        ForgetPassword::dispatch(['token' => $token, 'email' => $request->email]);

        // Mail::send('mail.forget-password', ["token" => $token, "email" => $request->email,], function ($message) use ($request) {
        //     $message->to($request->email);
        //     $message->subject("Quên mật khẩu");
        // });

        return back()->with("success", "Bạn hãy kiểm tra email của mình");
    }

    public function resetPassword($token, $email)
    {
        return view("auth.new-password", compact("token", "email"));
    }

    public function resetPasswordPost(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                "email" => "required|email|exists:users",
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]
        );

        $password_reset = PasswordReset::where(
            [
                "email" => $request->email,
                "token" => $request->token,
            ]
        )->first();

        if (!$password_reset) {
            return redirect()->route("reset.password")->with("error", "Đã có lỗi xảy ra");
        }

        $pass_hash = bcrypt($request->password);

        User::where("email", $request->email)->update(["password" => $pass_hash]);

        PasswordReset::where("email", $request->email)->delete();

        return redirect()->route("login")->with("success", "Cập nhật mật khẩu thành công, hãy đăng nhập");
    }
}
