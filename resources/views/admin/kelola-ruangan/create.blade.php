@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Ruangan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelola-ruangan.index') }}">Ruangan</a></div>
                <div class="breadcrumb-item active">Tambah</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Ruangan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kelola-ruangan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_ruangan">Nama Ruangan</label>
                                    <input type="text" name="nama_ruangan"
                                        class="form-control @error('nama_ruangan') is-invalid @enderror" required
                                        value="{{ old('nama_ruangan') }}">
                                    @error('nama_ruangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="photo">Foto Ruangan</label>
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
                                    <label for="kapasitas">Kapasitas</label>
                                    <input type="text" name="kapasitas"
                                        class="form-control @error('kapasitas') is-invalid @enderror"
                                        value="{{ old('kapasitas') }}">
                                    @error('kapasitas')
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



                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kelola-ruangan.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
