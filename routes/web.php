<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarberController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/admin/login', [AdminAuthController::class, 'index'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    
    Route::get('/admin/barber', [BarberController::class, 'index'])->name('barber.index');
    Route::post('/admin/barber', [BarberController::class, 'store'])->name('barber.store');
    Route::put('/admin/barber/{id}', [BarberController::class, 'update'])->name('barber.update');
    Route::delete('/admin/barber/{id}', [BarberController::class, 'destroy'])->name('barber.destroy');

    Route::get('/admin/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::post('/admin/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/admin/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/admin/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::post('/admin/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/admin/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/admin/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/admin/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::delete('/admin/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});