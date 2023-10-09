<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardUserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }

    public function logout(Request $request)
    {
        $guard = Auth::guard('web');
        $guard->logout();

        // Invalidasi sesi pengguna
        $request->session()->invalidate();

        // Menghapus cookie pengguna
        $request->session()->regenerateToken();

        // Redirect pengguna ke halaman login
        return redirect('/login');
    }

    public function getPhoto($filename)
    {
        // Tentukan direktori penyimpanan privat gambar pengguna
        $storagePath = storage_path("app/private/photos/{$filename}");

        // Periksa apakah file ada
        if (Storage::disk('private')->exists("photos/{$filename}")) {
            // Jika ada, kirimkan gambar sebagai respons
            return response()->file($storagePath);
        } else {
            // Jika file tidak ditemukan, kirimkan respons 404 (Not Found)
            abort(404);
        }
    }

    public function jadwal()
    {
        return view('user.jadwal.index');
    }
}
