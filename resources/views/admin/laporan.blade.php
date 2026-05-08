<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan | Barbershop Admin</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Style khusus untuk halaman laporan (opsional) */
        .summary-box {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }
        .total-card {
            background: #10b981; /* Green */
            color: white;
            padding: 20px 40px;
            border-radius: 10px;
            text-align: right;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            min-width: 300px;
        }
        /* Hide sidebar/buttons saat print */
        @media print {
            .sidebar, .topbar button, .logout { display: none; }
            .main { margin-left: 0; padding: 0; }
            .summary-box { justify-content: center; }
        }
    </style>
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
            <div>
                <h2>Laporan Pendapatan</h2>
                <span style="color: #64748b;">Rekapitulasi Seluruh Transaksi</span>
            </div>
            <button onclick="window.print()" class="btn-primary" style="width: auto; padding: 10px 20px;">
                <i class="fa-solid fa-print"></i> Cetak Laporan
            </button>
        </div>

        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th style="text-align: right;">Nominal (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->created_at->format('d M Y H:i') }}</td> <td style="font-family: monospace; font-weight: bold;">
                                #{{ $item->kode_transaksi ?? $item->id }}
                            </td>
                            <td style="text-align: right;">
                                Rp {{ number_format($item->total_bayar, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding: 20px; color: #64748b;">
                                Belum ada data transaksi yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="summary-box">
            <div class="total-card">
                <p style="font-size: 14px; opacity: 0.9;">Total Pendapatan Bersih</p>
                <h1 style="font-size: 36px; margin-top: 5px;">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h1>
            </div>
        </div>
    </div>

</body>
</html>