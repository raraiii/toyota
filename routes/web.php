<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Admin\DashboardController as AdminController;
use App\Http\Controllers\User\DashboardController as UserController;
use App\Http\Controllers\Sales\MobilController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\InventoryController;

Auth::routes();

// Halaman Landing
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes (Login, Register, dll)
Auth::routes();

// --- ROUTE USER (Folder User) ---
// --- ROUTE USER ---
Route::middleware(['auth', 'role:user,admin'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    // Tambahkan route show ini
    Route::get('/mobil/{id}', [UserController::class, 'show'])->name('user.mobil.show');
});

// --- ROUTE ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // UBAH BARIS INI:
    // Tambahkan prefix 'admin.' agar sesuai dengan yang Anda panggil di Blade
   
    // Tambahkan ->name() pada route sales kamu
    Route::get('/sales', [SalesController::class, 'index'])->name('admin.sales.index');
    Route::get('/sales/create', [SalesController::class, 'create'])->name('admin.sales.create');
    Route::post('/sales', [SalesController::class, 'store'])->name('admin.sales.store');

    Route::post('/sales/reset-password/{id}', [SalesController::class, 'resetPassword'])->name('admin.sales.reset-password');

    // Route untuk ubah status aktif/tidak aktif
    Route::patch('/sales/{id}/toggle-status', [SalesController::class, 'toggleStatus'])->name('admin.sales.toggle');

    // Route untuk hapus akun
    Route::delete('/sales/{id}', [SalesController::class, 'destroy'])->name('admin.sales.destroy');

    // Route untuk Import & Download Template
    Route::post('/sales/import', [SalesController::class, 'import'])->name('sales.import');
    Route::get('/sales/template', [SalesController::class, 'downloadTemplate'])->name('sales.download-template');

    // Route untuk Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('admin.inventory.index');});

    // Route untuk ke survei
    Route::post('/mobil/{id}/survei', [InventoryController::class, 'keSurvei'])->name('admin.mobil.survei');
    Route::get('/survei', [InventoryController::class, 'survei'])->name('admin.survei.index');

    // Route untuk status
    Route::get('/status/{filter?}', [InventoryController::class, 'status'])->name('admin.status.index');
    Route::post('/mobil/{id}/lolos', [InventoryController::class, 'lolos'])
    ->name('admin.mobil.lolos');

Route::post('/mobil/{id}/gagal', [InventoryController::class, 'gagal'])
    ->name('admin.mobil.gagal');

    
// --- ROUTE SALES ---
Route::middleware(['auth', 'role:sales'])->prefix('sales')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Sales\DashboardController::class, 'index'])->name('sales.dashboard');
    Route::resource('mobil', App\Http\Controllers\Sales\MobilController::class)->names('sales.mobil');
    
    // Route Profil Baru
    Route::get('/profil', [App\Http\Controllers\Sales\ProfilController::class, 'index'])->name('sales.profil.index');
    Route::put('/profil', [App\Http\Controllers\Sales\ProfilController::class, 'update'])->name('sales.profil.update');
});

// Route Bebas Login (API/Utility)
Route::post('/send-otp-only', [OtpController::class, 'sendOtp'])->name('otp.send_only');
Route::post('/verify-otp-only', [OtpController::class, 'verifyOtpOnly'])->name('otp.verify_only');