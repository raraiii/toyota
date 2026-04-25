<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Admin\DashboardController as AdminController;
use App\Http\Controllers\User\DashboardController as UserController;
use App\Http\Controllers\Admin\MobilController;

Auth::routes();

// Halaman Landing
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes (Login, Register, dll)
Auth::routes();

// --- ROUTE USER (Folder User) ---
Route::middleware(['auth', 'role:user,admin'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// --- ROUTE ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // UBAH BARIS INI:
    // Tambahkan prefix 'admin.' agar sesuai dengan yang Anda panggil di Blade
    Route::resource('mobil', MobilController::class)->names('admin.mobil');
});

// Route Bebas Login (API/Utility)
Route::post('/send-otp-only', [OtpController::class, 'sendOtp'])->name('otp.send_only');
Route::post('/verify-otp-only', [OtpController::class, 'verifyOtpOnly'])->name('otp.verify_only');