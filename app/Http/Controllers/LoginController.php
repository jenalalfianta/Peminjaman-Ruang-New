<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;

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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Jika validasi gagal, kembalikan pengguna ke halaman login dengan pesan error
        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // Coba melakukan autentikasi
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Periksa apakah pengguna aktif dan email telah diverifikasi
            $user = Auth::user();
            if ($user->is_active && $user->email_verified_at) {
                // Jika berhasil dan akun aktif, arahkan pengguna ke halaman dashboard
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                // Jika akun tidak aktif atau email belum diverifikasi, kembalikan pesan error
                Auth::logout(); // Logout pengguna jika akun tidak aktif atau email belum diverifikasi
                return redirect()->route('login')
                    ->withErrors(['email' => 'Akun tidak aktif atau email belum diverifikasi. Silakan hubungi admin.'])
                    ->withInput();
            }
        }

        // Jika autentikasi gagal, kembalikan pengguna ke halaman login dengan pesan error kredensial tidak valid
        return redirect()->route('login')
            ->withErrors(['email' => 'Kredensial tidak valid.'])
            ->withInput();
    }

}
