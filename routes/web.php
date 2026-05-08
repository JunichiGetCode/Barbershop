<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarberController; // Pastikan ini ada

// --- GUEST ROUTES ---
Route::get('/', function () {
    return redirect()->route('login'); // Redirect root ke login
});

// Halaman Login
Route::get('/admin/login', [AdminAuthController::class, 'index'])->name('login');
// Proses Login
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


// --- AUTH ROUTES (Sudah Login) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Laporan
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    
    // --- Module Barber (BARU) ---
    // Menangani Read, Create, Update, Delete
    Route::get('/admin/barber', [BarberController::class, 'index'])->name('barber.index');
    Route::post('/admin/barber', [BarberController::class, 'store'])->name('barber.store');
    Route::put('/admin/barber/{id}', [BarberController::class, 'update'])->name('barber.update'); // Penting untuk Edit Modal
    Route::delete('/admin/barber/{id}', [BarberController::class, 'destroy'])->name('barber.destroy');

    // --- Module Layanan ---
    Route::get('/admin/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::post('/admin/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/admin/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update'); // Tambahkan jika ingin fitur Edit
    Route::delete('/admin/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

    // --- Module Pelanggan ---
    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::post('/admin/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/admin/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update'); // Tambahkan jika ingin fitur Edit
    Route::delete('/admin/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    // --- Module Produk ---
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('produk.update'); // Tambahkan jika ingin fitur Edit
    Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // --- Module Transaksi ---
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/admin/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::delete('/admin/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});