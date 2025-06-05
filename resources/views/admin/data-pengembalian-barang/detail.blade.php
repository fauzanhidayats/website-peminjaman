@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Pengembalian Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pengembalian-barang.index') }}">Pengembalian</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Pengembalian Barang</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Peminjam</th>
                                    <td>{{ $pengembalian->peminjamanBarang->user->username ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Barang</th>
                                    <td>{{ $pengembalian->peminjamanBarang->barang->nama_barang ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah yang Dipinjam</th>
                                    <td>{{ $pengembalian->peminjamanBarang->jumlah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Dikembalikan</th>
                                    <td>{{ $pengembalian->jumlah_dikembalikan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pinjam</th>
                                    <td>{{ $pengembalian->peminjamanBarang->tgl_pinjam ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Dikembalikan</th>
                                    <td>{{ $pengembalian->tgl_dikembalikan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span
                                            class="badge badge-{{ $pengembalian->status === 'dikembalikan' ? 'success' : 'warning' }}">
                                            {{ ucfirst($pengembalian->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat pada</th>
                                    <td>{{ $pengembalian->created_at->format('d M Y - H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui pada</th>
                                    <td>{{ $pengembalian->updated_at->format('d M Y - H:i') }}</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <a href="{{ route('pengembalian-barang.edit', $pengembalian->id) }}"
                                    class="btn btn-primary">Edit</a>
                                <a href="{{ route('pengembalian-barang.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
