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
                            <a href="{{ route('kelola-ruangan.create') }}" class="btn btn-success">Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Photo</th>
                                            <th>Nama Ruangan</th>
                                            <th>Kondisi</th>
                                            <th>Kapasitas</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ruangans as $index => $ruangan)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if ($ruangan->photo)
                                                        <img src="{{ asset('storage/' . $ruangan->photo) }}"
                                                            alt="Foto Barang" width="60">
                                                    @else
                                                        <span class="text-muted">Tidak ada foto</span>
                                                    @endif
                                                </td>
                                                <td>{{ $ruangan->nama_ruangan }}</td>
                                                <td>{{ $ruangan->kondisi ?? '-' }}</td>
                                                <td>{{ $ruangan->kapasitas ?? '-' }}</td>
                                                <td>{{ $ruangan->lokasi ?? '-' }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('kelola-ruangan.show', $ruangan->id) }}">
                                                            <i class="fa fa-eye bg-success text-white p-2 rounded"></i>
                                                        </a>
                                                        <a href="{{ route('kelola-ruangan.edit', $ruangan->id) }}">
                                                            <i
                                                                class="fa fa-edit bg-primary text-white p-2 rounded mx-1"></i>
                                                        </a>
                                                        <form action="{{ route('kelola-ruangan.destroy', $ruangan->id) }}"
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
                                        @endforeach

                                        @if ($ruangans->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Belum ada data Ruangan
                                                </td>
                                            </tr>
                                        @endif
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
