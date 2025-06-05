@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelola-barang.index') }}">Barang</a></div>
                <div class="breadcrumb-item active">Tambah</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Barang</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kelola-barang.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" name="nama_barang"
                                        class="form-control @error('nama_barang') is-invalid @enderror"
                                        value="{{ old('nama_barang') }}" required>
                                    @error('nama_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="photo">Foto Barang</label>
                                    <input type="file" name="photo"
                                        class="form-control-file @error('photo') is-invalid @enderror">
                                    @error('photo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
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

                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi"
                                        class="form-control @error('lokasi') is-invalid @enderror"
                                        value="{{ old('lokasi') }}">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" name="stok" min="0"
                                        class="form-control @error('stok') is-invalid @enderror"
                                        value="{{ old('stok', 0) }}">
                                    @error('stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kelola-barang.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
