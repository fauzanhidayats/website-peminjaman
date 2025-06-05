@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjaman Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item active">Peminjaman Barang</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Peminjam</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kegiatan</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tgl Kembali</th>
                                            <th>Status</th>
                                            <th>Surat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($peminjamanBarangs as $index => $item)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $item->user->username ?? '-' }}</td>
                                                <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>{{ $item->kegiatan ?? '-' }}</td>
                                                <td>{{ $item->tgl_pinjam }}</td>
                                                <td>{{ $item->tgl_kembali }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $item->status === 'diajukan' ? 'warning' : ($item->status === 'diterima' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($item->surat_peminjaman)
                                                        <a href="{{ route('admin.peminjaman-barang.surat', $item->id) }}"
                                                            class="btn btn-sm btn-outline-info" target="_blank">
                                                            <i class="fa fa-download"></i> Surat
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Belum tersedia</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.peminjaman-barang.edit', $item->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center text-muted">Belum ada data peminjaman
                                                    barang.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
