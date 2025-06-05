@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelola-kendaraan.index') }}">Kendaraan</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                @if ($kendaraan->photo)
                                    <img src="{{ asset('storage/' . $kendaraan->photo) }}" alt="Foto Kendaraan"
                                        class="img-fluid rounded" style="max-width: 200px;">
                                @else
                                    <p class="text-muted">Tidak ada foto</p>
                                @endif
                            </div>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Kendaraan</th>
                                    <td>{{ $kendaraan->nama_kendaraan }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis</th>
                                    <td>{{ $kendaraan->jenis ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Polisi</th>
                                    <td>{{ $kendaraan->nomor_polisi }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>{{ $kendaraan->kondisi ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Dibuat pada</th>
                                    <td>{{ $kendaraan->created_at->format('d M Y - H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui pada</th>
                                    <td>{{ $kendaraan->updated_at->format('d M Y - H:i') }}</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <a href="{{ route('kelola-kendaraan.edit', $kendaraan->id) }}"
                                    class="btn btn-primary">Edit</a>
                                <a href="{{ route('kelola-kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
