<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\RoomBookingAdminController;
use App\Http\Controllers\Admin\RuangController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\RoomBookingUserController;
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




//////////////////////////custom//////////////////////////////////////////////

// Rute untuk mengakses foto pengguna yang disimpan secara privat
Route::get('/user/photo/{filename}', [UserController::class, 'getPhoto'])->name('user.photo');

// defualt route /
Route::get('/', function () {
    return redirect('/login');
});


//////////////////////////user//////////////////////////////////////////////

Route::middleware(['auth', 'web', 'checkRole:user'])->group(function () {
    // Dashboard pengguna
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

});


//////////////////////////admin//////////////////////////////////////////////

Route::middleware(['auth', 'admin', 'checkRole:admin'])->group(function () {
    // Route admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Route manajemen user
    Route::resource('/admin/users', PenggunaController::class)->except(['show']);
    // Route manajemen user Search
    Route::get('/admin/users/search', [PenggunaController::class, 'search'])->name('admin.users.search');

    // Route manajemen ruang
    Route::resource('/admin/ruang', RuangController::class)->except(['show']);
    // Route manajemen ruang Search
    Route::get('/admin/ruang/search', [RuangController::class, 'search'])->name('admin.ruang.search');

});


//////////////////////////authentication///////////////////////////////////////

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

// Rute untuk menampilkan formulir lupa password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Rute untuk mengirim email reset password
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Rute untuk menampilkan formulir reset password
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

// Rute untuk menyimpan perubahan password setelah reset
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
