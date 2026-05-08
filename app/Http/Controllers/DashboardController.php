<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Jangan lupa import semua model
use App\Models\Pelanggan;
use App\Models\Barber;
use App\Models\Layanan;
use App\Models\Produk;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Data (Untuk Kartu di Atas)
        $totalPelanggan = Pelanggan::count();
        $totalBarber    = Barber::count();
        $totalLayanan   = Layanan::count();
        $totalProduk    = Produk::count();
        $totalTransaksi = Transaksi::count();

        // 2. Ambil Data Transaksi Terbaru (Untuk Tabel di Bawah)
        // Mengambil 5 data terakhir, diurutkan dari yang paling baru
        $transaksiTerbaru = Transaksi::latest()->take(5)->get();

        // 3. Kirim semua data ke View
        return view('admin.dashboard', compact(
            'totalPelanggan', 
            'totalBarber', 
            'totalLayanan', 
            'totalProduk', 
            'totalTransaksi',
            'transaksiTerbaru' // <--- Ini yang sebelumnya kurang/hilang
        ));
    }
}