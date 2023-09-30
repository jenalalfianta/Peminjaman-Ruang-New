<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'user') {
                return redirect()->route('user.dashboard');
            }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika kredensial benar, arahkan pengguna ke dashboard sesuai peran (user atau admin)
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Jika kredensial salah, arahkan pengguna kembali ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->withErrors(['email' => 'Kredensial tidak valid.']);
    }
}


