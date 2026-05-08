<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil data terbaru dulu (latest)
        $transaksi = Transaksi::latest()->get();
        // Arahkan ke folder transaksi/index.blade.php
        return view('transaksi.index', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|string|unique:transaksis,kode_transaksi',
            'total_bayar'    => 'required|numeric|min:0',
        ]);

        Transaksi::create($request->all());

        return redirect()->back()->with('success', 'Transaksi berhasil dicatat!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->back()->with('success', 'Data transaksi dihapus!');
    }
}