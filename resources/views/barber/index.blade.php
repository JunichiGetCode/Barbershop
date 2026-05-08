<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barber | Barbershop Admin</title>
    
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
            <h2>Manajemen Barber</h2>
            <span>Admin Panel</span>
        </div>

        @if(session('success'))
            <div class="alert">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert" style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card" style="background: white; color: #333; margin-bottom: 20px;">
            <h4 style="margin-bottom: 10px;">Tambah Barber Baru</h4>
            <form action="{{ route('barber.store') }}" method="POST">
                @csrf
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="nama" placeholder="Nama Barber" required style="flex: 1;">
                    <input type="text" name="pengalaman" placeholder="Pengalaman (misal: 2 Tahun)" required style="flex: 1;">
                    <button type="submit" class="btn-primary" style="width: auto; padding: 0 25px;">
                        <i class="fa-solid fa-plus"></i> Tambah
                    </button>
                </div>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Barber</th>
                    <th>Pengalaman</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barbers as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $item->nama }}</strong></td>
                    <td>{{ $item->pengalaman }}</td>
                    <td>
                        <button onclick="openEditModal({{ $item->id }}, '{{ $item->nama }}', '{{ $item->pengalaman }}')" 
                                class="btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </button>
                        
                        <form action="{{ route('barber.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Yakin ingin menghapus barber ini?');">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px;">
                        Belum ada data barber. Silakan tambah data baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 style="margin-bottom: 20px;">Edit Data Barber</h3>
            
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <label>Nama Barber</label>
                <input type="text" id="edit_nama" name="nama" required>
                
                <label>Pengalaman</label>
                <input type="text" id="edit_pengalaman" name="pengalaman" required>
                
                <div class="modal-footer">
                    <button type="button" onclick="closeEditModal()" class="btn-secondary">Batal</button>
                    <button type="submit" class="btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // --- Logic Modal Edit ---
        function openEditModal(id, nama, pengalaman) {
            // PENTING: Sesuaikan path dengan route di web.php (/admin/barber/{id})
            document.getElementById('editForm').action = '/admin/barber/' + id;
            
            // Isi form dengan data lama
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_pengalaman').value = pengalaman;
            
            // Tampilkan modal
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Tutup modal jika user klik area gelap di luar modal
        window.onclick = function(event) {
            var modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>