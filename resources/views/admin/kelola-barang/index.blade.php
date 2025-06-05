@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Dashboard</a>
                </div>
                <div class="breadcrumb-item"><a href="#">Modules</a></div>
                <div class="breadcrumb-item">DataTables</div>
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
                            <a href="{{ route('kelola-barang.create') }}" class="btn btn-success">Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Photo</th>
                                            <th>Nama Barang</th>
                                            <th>Kondisi</th>
                                            <th>Lokasi</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($barangs as $index => $barang)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if ($barang->photo)
                                                        <img src="{{ asset('storage/' . $barang->photo) }}"
                                                            alt="Foto Barang" width="60">
                                                    @else
                                                        <span class="text-muted">Tidak ada foto</span>
                                                    @endif
                                                </td>
                                                <td>{{ $barang->nama_barang }}</td>
                                                <td>{{ $barang->kondisi ?? '-' }}</td>
                                                <td>{{ $barang->lokasi ?? '-' }}</td>
                                                <td>{{ $barang->stok }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('kelola-barang.show', $barang->id) }}">
                                                            <i class="fa fa-eye bg-success text-white p-2 rounded"></i>
                                                        </a>
                                                        <a href="{{ route('kelola-barang.edit', $barang->id) }}">
                                                            <i
                                                                class="fa fa-edit bg-primary text-white p-2 rounded mx-1"></i>
                                                        </a>
                                                        <form action="{{ route('kelola-barang.destroy', $barang->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
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
                                                <td colspan="8" class="text-center text-muted">Belum ada data barang</td>
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
