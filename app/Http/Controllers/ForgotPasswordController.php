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

    public function showResetForm(Request $request)
    {
        $token = $request->route('token'); // Ambil token dari URL
        $email = $request->email; // Ambil email dari URL

        return view('auth.reset', compact('token', 'email'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('token', 'email', 'password', 'password_confirmation'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password Anda berhasil direset. Silakan masuk.');
        } else {
            return back()->withErrors(['email' => __($status)])
                ->with('error', 'Terjadi kesalahan. Password tidak dapat direset.');
        }
    }

}
