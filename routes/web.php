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

// defualt route /
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'web', 'checkRole:user'])->group(function () {
    // Dashboard pengguna
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    
    // Menampilkan list peminjaman
    Route::get('/user/booking', [RoomBookingUserController::class, 'showBookingView'])->name('user.room.booking');

    // Menampilkan formulir pemesanan ruangan
    Route::get('/user/booking/create', [RoomBookingUserController::class, 'showBookingForm'])->name('user.booking.create');
    
    // Menyimpan peminjaman ruangan
    Route::post('/user/booking', [RoomBookingUserController::class, 'storeBooking'])->name('user.booking.store');

    // Menampilkan daftar peminjaman ruangan oleh pengguna
    Route::get('/user/bookings', [RoomBookingUserController::class, 'showBookings'])->name('user.bookings');

    // Menampilkan rincian peminjaman tertentu
    Route::get('/user/booking/{id}', [RoomBookingController::class, 'getBookingDetails'])->name('user.booking.details');

    // Rute untuk pencarian ruangan
    Route::get('/user/rooms/search', [RoomSearchController::class, 'searchRooms'])->name('user.rooms.search');
});

Route::middleware(['auth', 'admin', 'checkRole:admin'])->group(function () {
    // Route admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Route manajemen user
    Route::resource('/admin/users', PenggunaController::class)->except(['show']);
    // Route manajemen user Batch Insert dan Search
    Route::post('/admin/users/batchInsert', [PenggunaController::class, 'batchInsert'])->name('admin.users.batchInsert');
    Route::get('/admin/users/search', [PenggunaController::class, 'search'])->name('admin.users.search');

    // Route manajemen ruang
    Route::resource('/admin/ruang', RuangController::class)->except(['show']);
    // Route manajemen ruang Batch Insert dan Search
    Route::post('/admin/ruang/batchInsert', [RuangController::class, 'batchInsert'])->name('admin.ruang.batchInsert');
    Route::get('/admin/ruang/search', [RuangController::class, 'search'])->name('admin.ruang.search');

    // Route manajemen room-booking
    Route::resource('/admin/room-booking', RoomBookingAdminController::class)->except(['show']);

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

// Rute untuk menampilkan formulir lupa password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Rute untuk mengirim email reset password
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Rute untuk menampilkan formulir reset password
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

// Rute untuk menyimpan perubahan password setelah reset
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
