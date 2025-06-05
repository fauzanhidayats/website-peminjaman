@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Dashboard</a>
                </div>
                <div class="breadcrumb-item"><a href="#">Manajemen</a></div>
                <div class="breadcrumb-item">Data Kendaraan</div>
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
                            <a href="{{ route('kelola-kendaraan.create') }}" class="btn btn-success">Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Photo</th>
                                            <th>Nama Kendaraan</th>
                                            <th>Jenis</th>
                                            <th>Nomor Polisi</th>
                                            <th>Kondisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kendaraans as $index => $kendaraan)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if ($kendaraan->photo)
                                                        <img src="{{ asset('storage/' . $kendaraan->photo) }}"
                                                            alt="Foto Kendaraan" width="60">
                                                    @else
                                                        <span class="text-muted">Tidak ada foto</span>
                                                    @endif
                                                </td>
                                                <td>{{ $kendaraan->nama_kendaraan }}</td>
                                                <td>{{ $kendaraan->jenis ?? '-' }}</td>
                                                <td>{{ $kendaraan->nomor_polisi }}</td>
                                                <td>{{ $kendaraan->kondisi ?? '-' }}</td>

                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('kelola-kendaraan.show', $kendaraan->id) }}">
                                                            <i class="fa fa-eye bg-success text-white p-2 rounded"></i>
                                                        </a>
                                                        <a href="{{ route('kelola-kendaraan.edit', $kendaraan->id) }}">
                                                            <i
                                                                class="fa fa-edit bg-primary text-white p-2 rounded mx-1"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('kelola-kendaraan.destroy', $kendaraan->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
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

                                        @if ($kendaraans->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">Belum ada data kendaraan
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
