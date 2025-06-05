@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Tempat</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelola-ruangan.index') }}">Tempat</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Ruangan</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                @if ($ruangan->photo)
                                    <img src="{{ asset('storage/' . $ruangan->photo) }}" alt="Foto Ruangan"
                                        class="img-fluid rounded" style="max-width: 200px;">
                                @else
                                    <p class="text-muted">Tidak ada foto</p>
                                @endif
                            </div>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Ruangan</th>
                                    <td>{{ $ruangan->nama_ruangan }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>{{ $ruangan->kondisi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kapasitas</th>
                                    <td>{{ $ruangan->kapasitas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $ruangan->lokasi ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Dibuat pada</th>
                                    <td>{{ $ruangan->created_at->format('d M Y - H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui pada</th>
                                    <td>{{ $ruangan->updated_at->format('d M Y - H:i') }}</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <a href="{{ route('kelola-ruangan.edit', $ruangan->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('kelola-ruangan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
