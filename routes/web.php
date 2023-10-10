<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\TransactionCancellationController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\DashboardUserController;
use App\Models\TransactionRoom;
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
Route::get('/user/photo/{filename}', [DashboardUserController::class, 'getPhoto'])->name('user.photo');

Route::get('/', function () {
    return view('index');
})->name('beranda');

//////////////////////////user//////////////////////////////////////////////
Route::middleware(['auth', 'web', 'checkRole:user'])->group(function () {
    // Dashboard pengguna
    Route::get('/user/dashboard', [DashboardUserController::class, 'dashboard'])->name('user.dashboard');

    // Logout untuk pengguna
    Route::post('/user/logout', [DashboardUserController::class, 'logout'])->name('user.logout');

    // Jadwal Ruang untuk pengguna
    Route::get('/user/jadwal', [DashboardUserController::class, 'jadwal'])->name('user.jadwal');
});


//////////////////////////admin//////////////////////////////////////////////
Route::middleware(['auth', 'admin', 'checkRole:admin'])->group(function () {
    // Route admin
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'dashboard'])->name('admin.dashboard');
    // Logout untuk admin
    Route::post('/admin/logout', [DashboardAdminController::class, 'logout'])->name('admin.logout');


    // Route manajemen user
    Route::resource('/admin/users', UserController::class)->except(['show']);
    // Route manajemen user Search
    Route::get('/admin/users/search', [UserController::class, 'search'])->name('admin.users.search');
    
    /// Route manajemen room
    Route::resource('/admin/room', RoomController::class)->except(['show']);
    /// Route manajemen room Search
    Route::get('/admin/room/search', [RoomController::class, 'search'])->name('admin.room.search');

    /// Rute untuk Room Booking
    Route::get('/admin/jadwal', [TransactionController::class, 'index'])->name('admin.jadwal');
    Route::post('/admin/jadwal/konfirmasi/{id}', [TransactionController::class, 'confirmTransaction'])->name('admin.jadwal.konfirmasi');
    Route::post('/admin/jadwal', [TransactionController::class, 'create']);

    //// Rute untuk Booking Cancellation
    Route::post('/admin/booking-cancellations', [TransactionCancellationController::class, 'create']);

    ///// Rute untuk Booking Room
    Route::post('/admin/booking-rooms', [TransactionRoom::class, 'create']);
    
});


//////////////////////////authentication///////////////////////////////////////
// Rute untuk menampilkan login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Tekan tombol login
Route::post('/login', [LoginController::class, 'login']);

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