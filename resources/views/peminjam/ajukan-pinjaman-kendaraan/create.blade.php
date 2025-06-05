@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ajukan Peminjaman Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Peminjaman</a></div>
                <div class="breadcrumb-item active">Ajukan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    {{-- Tampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Form Pengajuan Peminjaman Kendaraan</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('peminjaman-kendaraan.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

                                <div class="form-group">
                                    <label for="nama_kendaraan">Kendaraan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $kendaraan->nama_kendaraan ?? '-' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="keperluan">Keperluan</label>
                                    <input type="text" name="keperluan" class="form-control"
                                        value="{{ old('keperluan') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Mulai</label>
                                    <input type="date" name="tgl_mulai" class="form-control"
                                        value="{{ old('tgl_mulai') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Selesai</label>
                                    <input type="date" name="tgl_selesai" class="form-control"
                                        value="{{ old('tgl_selesai') }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Ajukan</button>
                                <a href="{{ route('peminjaman-kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
