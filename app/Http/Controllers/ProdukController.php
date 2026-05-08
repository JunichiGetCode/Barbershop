<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    // READ: Menampilkan halaman produk
    public function index()
    {
        $produk = Produk::all();
        
        // Perbaikan Path View: Arahkan ke folder 'produk/index.blade.php'
        return view('produk.index', compact('produk')); 
    }

    // CREATE: Menyimpan data baru
    public function store(Request $request)
    {
        // 1. Validasi Input (Termasuk Harga)
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0', // Tambahan validasi harga
            'stok'        => 'required|integer|min:0', 
        ]);

        // 2. Simpan ke database
        // Gunakan Mass Assignment agar lebih singkat
        Produk::create($request->all());

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // UPDATE: Mengubah data (Untuk Fitur Edit)
    public function update(Request $request, $id)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ]);

        // 2. Cari dan Update
        $produk = Produk::findOrFail($id);
        
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
        ]);

        return redirect()->back()->with('success', 'Data produk berhasil diperbarui!');
    }

    // DELETE: Menghapus data
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}