@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Pengembalian Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item active">Pengembalian</div>
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
                            <a href="{{ route('pengembalian-barang.create') }}" class="btn btn-success">
                                Tambah Pengembalian
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Peminjam</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Dikembalikan</th>
                                            <th>Tanggal Dikembalikan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pengembalians as $index => $pengembalian)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $pengembalian->peminjamanBarang->user->username ?? '-' }}</td>
                                                <td>{{ $pengembalian->peminjamanBarang->barang->nama_barang ?? '-' }}</td>
                                                <td>{{ $pengembalian->jumlah_dikembalikan }}</td>
                                                <td>{{ $pengembalian->tgl_dikembalikan ?? '-' }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $pengembalian->status === 'dikembalikan' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($pengembalian->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('pengembalian-barang.show', $pengembalian->id) }}"
                                                            class="mr-1">
                                                            <i class="fa fa-eye bg-success text-white p-2 rounded"></i>
                                                        </a>
                                                        <a href="{{ route('pengembalian-barang.edit', $pengembalian->id) }}"
                                                            class="mr-1">
                                                            <i class="fa fa-edit bg-primary text-white p-2 rounded"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('pengembalian-barang.destroy', $pengembalian->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn p-0">
                                                                <i class="fa fa-trash bg-danger text-white p-2 rounded"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Belum ada data
                                                    pengembalian barang.</td>
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
