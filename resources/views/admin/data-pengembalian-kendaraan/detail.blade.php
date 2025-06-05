@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Pengembalian Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pengembalian-kendaraan.index') }}">Pengembalian</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Pengembalian Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Peminjam</th>
                                    <td>{{ $pengembalian->peminjamanKendaraan->user->username ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Kendaraan</th>
                                    <td>{{ $pengembalian->peminjamanKendaraan->kendaraan->nama_kendaraan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mulai Pinjam</th>
                                    <td>{{ $pengembalian->peminjamanKendaraan->tgl_mulai ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Selesai Pinjam</th>
                                    <td>{{ $pengembalian->peminjamanKendaraan->tgl_selesai ?? '-' }}</td>
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
                                <a href="{{ route('pengembalian-kendaraan.edit', $pengembalian->id) }}"
                                    class="btn btn-primary">Edit</a>
                                <a href="{{ route('pengembalian-kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
