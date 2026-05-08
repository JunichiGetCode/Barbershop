<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi | Barbershop Admin</title>
    
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
            <h2>Data Transaksi</h2>
            <span>Rekapitulasi Pembayaran</span>
        </div>

        @if(session('success'))
            <div class="alert">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert" style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card" style="background: white; color: #333; margin-bottom: 20px;">
            <h4 style="margin-bottom: 15px;">Catat Transaksi Baru</h4>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <input type="text" name="kode_transaksi" placeholder="Kode (Cth: TRX-001)" required style="margin: 0; width: 100%;">
                    </div>
                    
                    <div style="flex: 2;">
                        <input type="number" name="total_bayar" placeholder="Total Bayar (Rp)" required style="margin: 0; width: 100%;">
                    </div>
                    
                    <button type="submit" class="btn-primary" style="width: auto; padding: 0 30px; margin: 0;">
                        <i class="fa-solid fa-plus"></i> Simpan
                    </button>
                </div>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Tanggal</th>
                    <th>Kode Transaksi</th>
                    <th>Total Bayar</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td><span style="background: #e2e8f0; padding: 4px 8px; border-radius: 4px; font-size: 0.9em; font-family: monospace;">{{ $item->kode_transaksi }}</span></td>
                    <td style="font-weight: bold; color: #059669;">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Yakin ingin menghapus riwayat transaksi ini?');">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #64748b;">
                        Belum ada data transaksi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>