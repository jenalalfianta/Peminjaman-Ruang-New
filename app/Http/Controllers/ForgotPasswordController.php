<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('auth.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)])
                        ->with('success', 'Tautan reset password telah dikirim ke email Anda.');
        } else {
            return back()->withErrors(['email' => __($status)])
                        ->with('error', 'Maaf, terdapat kesalahan. Tautan reset password tidak dapat dikirim.');
        }
    }

    public function showResetForm($token)
    {
        return view('auth.reset')->with(['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8', // Add your password validation rules here
        ]);
    
        $status = Password::reset(
            $request->only('token', 'password', 'password_confirmation'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );
    
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['password' => [__($status)]]);
    }

}
