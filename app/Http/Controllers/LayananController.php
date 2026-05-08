<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // MENAMPILKAN DATA (READ)
    public function index()
    {
        // Kode Anda yang tadi seharusnya di sini:
        $layanan = Layanan::all(); 
        return view('layanan.index', compact('layanan'));
    }

    // MENYIMPAN DATA (CREATE)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric'
        ]);

        Layanan::create($request->all());

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric'
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update($request->all());

        return redirect()->back()->with('success', 'Layanan berhasil diperbarui!');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }
}