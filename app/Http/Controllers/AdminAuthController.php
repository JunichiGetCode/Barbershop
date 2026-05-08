<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('admin.login'); 
    }

    // Proses Login
    public function login(Request $request)
    {
        // 1. Validasi Input (Gunakan Email)
        $credentials = $request->validate([
            'email' => ['required', 'email'], // Pastikan format email valid
            'password' => ['required'],
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // SUKSES: Redirect ke Dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // 3. GAGAL: Kembali ke halaman login dengan pesan error
        return back()->with('error', 'Email atau Password yang Anda masukkan salah!')->withInput();
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Kembali ke route login
    }
}