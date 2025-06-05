<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">UNBAJA</a>
        </div>
        <ul class="sidebar-menu">


            @if (auth()->user()->role->nama_role === 'admin')
                <li class="menu-header">Dashboard</li>
                <li>
                    <a class="nav-link" href="{{ route('dashboard.admin') }}"><i class="fas fa-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Kelola Data</li>
                <li>
                    <a class="nav-link" href="{{ route('kelola-barang.index') }}"><i class="fas fa-toolbox"></i>
                        <span>Data Barang</span></a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('kelola-ruangan.index') }}"><i class="fas fa-building"></i>
                        <span>Data Ruangan</span></a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('kelola-kendaraan.index') }}"><i class="fas fa-car"></i>
                        <span>Data Kendaraan</span></a>
                </li>
                <li class="menu-header">Kelola Peminjaman</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-arrow-alt-circle-up"></i> <span>Peminjaman</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.peminjaman-barang.index') }}">Barang</a></li>
                        <li><a class="nav-link" href="{{ route('admin.peminjaman-ruangan.index') }}">Ruangan</a></li>
                        <li><a class="nav-link" href="{{ route('admin.peminjaman-kendaraan.index') }}">Kendaraan</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header">Kelola Pengembalian</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-arrow-alt-circle-down"></i> <span>Pengembalian</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('pengembalian-barang.index') }}">Barang</a></li>
                        <li><a class="nav-link" href="{{ route('pengembalian-ruangan.index') }}">Ruangan</a></li>
                        <li><a class="nav-link" href="{{ route('pengembalian-kendaraan.index') }}">Kendaraan</a></li>
                    </ul>
                </li>
                <li class="menu-header">Laporan</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-file-alt"></i> <span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.laporan.barang.index') }}">Data Barang</a></li>
                        <li><a class="nav-link" href="{{ route('admin.laporan.ruangan.index') }}">Data Ruangan</a></li>
                        <li><a class="nav-link" href="{{ route('admin.laporan.kendaraan.index') }}">Data Kendaraan</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header">Kelola Akun</li>
                <li>
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-user-alt"></i>
                        <span>User</span></a>
                </li>
            @elseif (auth()->user()->role->nama_role === 'peminjam')
                <li class="menu-header">Dashboard</li>
                <li>
                    <a class="nav-link" href="{{ route('dashboard.peminjam') }}"><i class="fas fa-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Menu</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-file-signature"></i> <span>Pinjaman Saya</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('peminjaman-barang.index') }}">Barang</a></li>
                        <li><a class="nav-link" href="{{ route('peminjaman-ruangan.index') }}">Ruangan</a></li>
                        <li><a class="nav-link" href="{{ route('peminjaman-kendaraan.index') }}">Kendaraan</a></li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('lihat-barang') }}"><i class="fas fa-toolbox"></i> <span>Lihat
                            Barang</span></a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('lihat-ruangan') }}"><i class="fas fa-building"></i>
                        <span>Lihat Ruangan</span></a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('lihat-kendaraan') }}"><i class="fas fa-car"></i>
                        <span>Lihat Kendaraan</span></a>
                </li>
            @elseif (auth()->user()->role->nama_role === 'pimpinan')
                <li class="menu-header">Dashboard</li>
                <li>
                    <a class="nav-link" href="{{ route('dashboard.pimpinan') }}"><i class="fas fa-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Laporan</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-file-alt"></i> <span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('pimpinan.laporan.barang.index') }}">Data Barang</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('pimpinan.laporan.ruangan.index') }}">Data Ruangan</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('pimpinan.laporan.kendaraan.index') }}">Data
                                Kendaraan</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </aside>
</div>
