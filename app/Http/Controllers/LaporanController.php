<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi; // Pastikan model Transaksi dipanggil

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data transaksi, urutkan dari yang terbaru
        $transaksi = Transaksi::orderBy('created_at', 'desc')->get();

        // 2. Hitung total sum dari kolom 'total_bayar'
        $totalPendapatan = Transaksi::sum('total_bayar');

        // 3. Kirim ke view
        return view('admin.laporan', compact('transaksi', 'totalPendapatan'));
    }
}