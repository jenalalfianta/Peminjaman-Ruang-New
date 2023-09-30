<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['dashboard']);
    }

    public function dashboard()
    {
        // Cek apakah pengguna adalah admin
        if (auth()->user()->role !== 'admin') {
            // Jika bukan admin, arahkan ke halaman lain atau berikan pesan kesalahan
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return view('admin.dashboard');
    }

    // Fungsi untuk logout admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
    
}