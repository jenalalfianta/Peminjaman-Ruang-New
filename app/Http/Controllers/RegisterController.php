<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function showRegistrasionForm()
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'user') {
                return redirect()->route('user.dashboard');
            }
        }

        return view('auth.register');
    }

    public function generateVerificationToken()
    {
        return Str::random(60); // Menghasilkan token acak sepanjang 60 karakter
    }

    public function register(Request $request)
    {
        // Periksa apakah email sudah terdaftar
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // Email sudah terdaftar, kembalikan pesan error ke halaman pendaftaran
            return redirect('/register')->withErrors(['email' => 'Email sudah terdaftar. Silakan coba dengan email lain.'])->withInput();
        }

        // Validasi data registrasi
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255|confirmed', // Konfirmasi email
            'password' => 'required|string|min:8|confirmed', // Konfirmasi password
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // Mengonversi nama ke ucwords
        $name = ucwords(strtolower($request->name));

        // Mengonversi email ke lowercase
        $email = strtolower($request->email);

        $token = $this->generateVerificationToken();

        // Jika validasi sukses, buat pengguna baru dan simpan token verifikasi
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($request->password),
            'verification_token' => $token, // Simpan token verifikasi
        ]);

        $user->update(['verification_token' => $token]); // Simpan token di kolom 'verification_token'

        // Kirim notifikasi email verifikasi langsung tanpa variabel $verificationLink
        $user->notify(new VerifyEmailNotification($token));

        return redirect('/register')->with('success', 'Registrasi berhasil. Silakan verifikasi email Anda.');
    }

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();

                // Login otomatis setelah verifikasi
                Auth::login($user);

                return redirect()->route('user.dashboard')->with('success', 'Email berhasil diverifikasi dan Anda sekarang sudah masuk.');
            }

            // Redirect ke halaman gagal verifikasi email jika diperlukan
            return redirect()->route('register')->with('error', 'EVerifikasi email gagal. Mohon periksa kembali tautan verifikasi Anda.');
        }

        // Redirect jika token tidak valid
        return redirect()->route('register')->with('error', 'Token verifikasi tidak valid.');
    }

}
