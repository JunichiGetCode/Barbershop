<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Barber;
use App\Models\Layanan;
use App\Models\Produk;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalBarber    = Barber::count();
        $totalLayanan   = Layanan::count();
        $totalProduk    = Produk::count();
        $totalTransaksi = Transaksi::count();

        $transaksiTerbaru = Transaksi::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPelanggan', 
            'totalBarber', 
            'totalLayanan', 
            'totalProduk', 
            'totalTransaksi',
            'transaksiTerbaru'
        ));
    }
}