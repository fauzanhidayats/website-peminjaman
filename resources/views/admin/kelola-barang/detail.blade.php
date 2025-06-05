@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelola-barang.index') }}">Barang</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Barang</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                @if ($barang->photo)
                                    <img src="{{ asset('storage/' . $barang->photo) }}" alt="Foto Barang"
                                        class="img-fluid rounded" style="max-width: 200px;">
                                @else
                                    <p class="text-muted">Tidak ada foto</p>
                                @endif
                            </div>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Barang</th>
                                    <td>{{ $barang->nama_barang }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>{{ $barang->kondisi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $barang->lokasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>{{ $barang->stok }}</td>
                                </tr>
                                <tr>
                                    <th>Dibuat pada</th>
                                    <td>{{ $barang->created_at->format('d M Y - H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui pada</th>
                                    <td>{{ $barang->updated_at->format('d M Y - H:i') }}</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <a href="{{ route('kelola-barang.edit', $barang->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('kelola-barang.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
