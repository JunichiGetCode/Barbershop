<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Dashboard Admin | Barbershop</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <div class="sidebar">
        <div class="brand">💈 Barbershop</div>
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Pelanggan
                </a>
            </li>
            <li>
                <a href="{{ route('barber.index') }}" class="{{ request()->routeIs('barber.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-scissors"></i> Barber
                </a>
            </li>
            <li>
                <a href="{{ route('layanan.index') }}" class="{{ request()->routeIs('layanan.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-list"></i> Layanan
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box"></i> Produk
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i> Transaksi
                </a>
            </li>
            <li>
                <a href="{{ route('admin.laporan') }}" class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-lines"></i> Laporan
                </a>
            </li>
            
            <li style="margin-top: 20px; border-top: 1px solid #1e293b;">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>

    <div class="main">
        <div class="topbar">
            <h2>Dashboard Overview</h2>
            <div style="display: flex; align-items: center; gap: 10px;">
                <span>Halo, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
                <div style="width: 35px; height: 35px; background: #cbd5e1; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>

        <div class="cards">
            <div class="card blue">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="font-size: 14px; opacity: 0.8;">Total Pelanggan</p>
                        <h1 style="font-size: 32px; margin-top: 5px;">{{ $totalPelanggan ?? 0 }}</h1>
                    </div>
                    <i class="fa-solid fa-users" style="font-size: 40px; opacity: 0.5;"></i>
                </div>
            </div>

            <div class="card green">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="font-size: 14px; opacity: 0.8;">Total Barber</p>
                        <h1 style="font-size: 32px; margin-top: 5px;">{{ $totalBarber ?? 0 }}</h1>
                    </div>
                    <i class="fa-solid fa-scissors" style="font-size: 40px; opacity: 0.5;"></i>
                </div>
            </div>

            <div class="card purple">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="font-size: 14px; opacity: 0.8;">Total Layanan</p>
                        <h1 style="font-size: 32px; margin-top: 5px;">{{ $totalLayanan ?? 0 }}</h1>
                    </div>
                    <i class="fa-solid fa-leaf" style="font-size: 40px; opacity: 0.5;"></i>
                </div>
            </div>

            <div class="card orange">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="font-size: 14px; opacity: 0.8;">Total Produk</p>
                        <h1 style="font-size: 32px; margin-top: 5px;">{{ $totalProduk ?? 0 }}</h1>
                    </div>
                    <i class="fa-solid fa-box" style="font-size: 40px; opacity: 0.5;"></i>
                </div>
            </div>

            <div class="card red">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="font-size: 14px; opacity: 0.8;">Total Transaksi</p>
                        <h1 style="font-size: 32px; margin-top: 5px;">{{ $totalTransaksi ?? 0 }}</h1>
                    </div>
                    <i class="fa-solid fa-receipt" style="font-size: 40px; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
        
        <div class="card" style="margin-top: 30px; background: white; color: #333;">
            <h3 style="margin-bottom: 20px; color: #1e293b;">Transaksi Terbaru</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span style="background: #e2e8f0; padding: 5px 10px; border-radius: 5px; font-family: monospace; font-weight: 600;">
                                {{ $item->kode_transaksi }}
                            </span>
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td style="color: #15803d; font-weight: bold;">
                            Rp {{ number_format($item->total_bayar, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: #64748b; padding: 20px;">
                            Belum ada data transaksi terbaru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>