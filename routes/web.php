<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
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

// Route::middleware(['guest'])->group(function(){
//     Route::get('/', [SesiController::class, 'index'])->name('login');
//     Route::post('/', [SesiController::class, 'login']);
// });

// Route::get('/home', function(){
//     return redirect('/admin');
// });

// Route::middleware(['auth'])->group(function(){
//     Route::get('/admin', [AdminController::class, 'index']);
//     Route::get('/admin/user', [AdminController::class, 'user']);
//     Route::get('/admin/admin', [AdminController::class, 'admin']);
//     Route::get('/logout', [SesiController::class, 'logout']);
// });

Route::middleware(['auth:web'])->group(function(){
    //Rute untuk user/pengguna
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

Route::middleware(['auth:admin', 'admin'])->group(function(){
    //Rute untuk admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Rute untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout untuk pengguna
Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');

// Logout untuk admin
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');