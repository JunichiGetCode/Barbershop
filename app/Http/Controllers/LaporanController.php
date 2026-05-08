<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::orderBy('created_at', 'desc')->get();

        $totalPendapatan = Transaksi::sum('total_bayar');

        return view('admin.laporan', compact('transaksi', 'totalPendapatan'));
    }
}