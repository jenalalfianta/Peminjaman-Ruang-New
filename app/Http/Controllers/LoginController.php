<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('login'); // Batasan 6 percobaan dalam 1 menit
    }

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

        // Cek apakah percobaan login melebihi batas, jika ya, kirimkan pesan kesalahan
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Coba melakukan autentikasi
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Jika berhasil, arahkan pengguna ke halaman dashboard
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Jika autentikasi gagal, tambahkan catatan percobaan login
        $this->incrementLoginAttempts($request);

        // Jika autentikasi gagal, kembalikan pengguna ke halaman login dengan pesan error kredensial tidak valid
        return redirect()->route('login')
            ->withErrors(['email' => 'Kredensial tidak valid.'])
            ->withInput();
    }

    // Metode ini mengembalikan apakah pengguna telah mencoba login terlalu banyak kali.
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($request), 6, 1
        );
    }

    // Metode ini menambahkan catatan percobaan login untuk pengguna yang berusaha login gagal.
    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request));
    }

    // Metode ini mengembalikan kunci yang digunakan oleh throttle untuk pengguna tertentu.
    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }

    // Metode ini menangani respon saat pengguna terlalu banyak mencoba login.
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        return redirect()->route('login')
            ->withErrors(['error' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $seconds . ' detik.'])
            ->withInput();
    }
}
