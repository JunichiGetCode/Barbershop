<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        return view('barber.index', compact('barbers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'pengalaman' => 'required'
        ]);

        Barber::create($request->all());

        return redirect()->back()->with('success', 'Barber berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'pengalaman' => 'required'
        ]);

        $barber = Barber::findOrFail($id);
        $barber->update($request->all());

        return redirect()->back()->with('success', 'Data Barber berhasil diupdate!');
    }

    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        $barber->delete();

        return redirect()->back()->with('success', 'Barber berhasil dihapus!');
    }
}