<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    // READ: Menampilkan Data
    public function index()
    {
        $pelanggan = Pelanggan::all();
        
        // PERBAIKAN UTAMA:
        // Arahkan ke folder 'pelanggan' file 'index.blade.php'
        // Jangan 'admin.pelanggan' lagi karena filenya sudah kita pindah agar rapi
        return view('pelanggan.index', compact('pelanggan'));
    }

    // CREATE: Menyimpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required|numeric', // Validasi angka
        ]);

        // Cara penulisan lebih singkat (Mass Assignment)
        Pelanggan::create($request->all());

        return redirect()->back()->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    // UPDATE: Mengubah Data (Untuk Fitur Edit Modal)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required|numeric',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        
        $pelanggan->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->back()->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    // DELETE: Menghapus Data
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->back()->with('success', 'Pelanggan berhasil dihapus!');
    }
}