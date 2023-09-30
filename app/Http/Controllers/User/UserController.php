<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function logout(Request $request)
    {
        $guard = Auth::guard('web');

        // Logout pengguna dari sesi
        $guard->logout();

        // Invalidasi sesi pengguna
        $request->session()->invalidate();

        // Menghapus cookie pengguna
        $request->session()->regenerateToken();

        // Redirect pengguna ke halaman login
        return redirect('/login');
    }




}
