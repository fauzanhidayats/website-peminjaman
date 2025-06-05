@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelola-kendaraan.index') }}">Kendaraan</a></div>
                <div class="breadcrumb-item active">Tambah</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kelola-kendaraan.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_kendaraan">Nama Kendaraan</label>
                                    <input type="text" name="nama_kendaraan"
                                        class="form-control @error('nama_kendaraan') is-invalid @enderror" required
                                        value="{{ old('nama_kendaraan') }}">
                                    @error('nama_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="photo">Foto Kendaraan</label>
                                    <input type="file" name="photo"
                                        class="form-control-file @error('photo') is-invalid @enderror">
                                    @error('photo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis">Jenis Kendaraan</label>
                                    <input type="text" name="jenis"
                                        class="form-control @error('jenis') is-invalid @enderror"
                                        value="{{ old('jenis') }}">
                                    @error('jenis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nomor_polisi">Nomor Polisi</label>
                                    <input type="text" name="nomor_polisi"
                                        class="form-control @error('nomor_polisi') is-invalid @enderror" required
                                        value="{{ old('nomor_polisi') }}">
                                    @error('nomor_polisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kondisi">Kondisi</label>
                                    <input type="text" name="kondisi"
                                        class="form-control @error('kondisi') is-invalid @enderror"
                                        value="{{ old('kondisi') }}">
                                    @error('kondisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kelola-kendaraan.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
