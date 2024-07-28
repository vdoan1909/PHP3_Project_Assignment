<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function showRequestForm()
    {
        return view('auth.reset');
    }

    public function sendResetEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $newPassword = Str::random(8);
            $user->password = bcrypt($newPassword);
            $user->save();

            Mail::send('mail.reset-password', ['newPassword' => $newPassword], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Your New Password');
            });

            return back()->with('status', 'A new password has been sent to your email address.');
        }

        return back()->withErrors(['email' => 'This email address is not registered in our system.']);
    }
}
