@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjaman Barang Saya</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Peminjaman Barang</div>
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
                        <div class="card-header">
                            <a href="{{ route('peminjaman-barang.index') }}" class="btn btn-primary">Ajukan Peminjaman</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kegiatan</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tgl Kembali</th>
                                            <th>Status</th>
                                            <th>Surat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($peminjamanBarangs as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
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
                                                        <a href="{{ asset('storage/' . $item->surat_peminjaman) }}"
                                                            target="_blank" class="btn btn-sm btn-outline-info">
                                                            <i class="fa fa-download"></i> Surat
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Belum tersedia</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">Belum ada pengajuan
                                                    peminjaman.</td>
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
