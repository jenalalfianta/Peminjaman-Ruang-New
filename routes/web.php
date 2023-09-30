<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Tempatkan rute verifikasi email di sini

Route::middleware(['auth', 'web', 'checkRole:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    // Definisikan rute lainnya untuk pengguna di sini
});

Route::middleware(['auth', 'admin', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Definisikan rute lainnya untuk admin di sini
    Route::resource('admin/users', PenggunaController::class);

});

// Rute untuk menampilkan login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Tekan tombol login
Route::post('/login', [LoginController::class, 'login']);

// Logout untuk pengguna
Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');

// Logout untuk admin
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Rute untuk menampilkan registrasi form
Route::get('/register', [RegisterController::class, 'showRegistrasionForm'])->name('register');

// Tekan tombol register
Route::post('/register', [RegisterController::class, 'register']);

// Rute Verifikasi Email
Route::get('/verify-email/{token}', [RegisterController::class, 'verifyEmail']);
