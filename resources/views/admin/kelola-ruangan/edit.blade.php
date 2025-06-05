@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Tempat</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelola-ruangan.index') }}">Tempat</a></div>
                <div class="breadcrumb-item active">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit Ruangan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kelola-ruangan.update', $ruangan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nama_ruangan">Nama Ruangan</label>
                                    <input type="text" name="nama_ruangan"
                                        class="form-control @error('nama_ruangan') is-invalid @enderror" required
                                        value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}">
                                    @error('nama_ruangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="photo">Foto Ruangan</label><br>
                                    @if ($ruangan->photo)
                                        <img src="{{ asset('storage/' . $ruangan->photo) }}" alt="Foto Ruangan"
                                            width="100" class="mb-2">
                                    @endif
                                    <input type="file" name="photo"
                                        class="form-control-file @error('photo') is-invalid @enderror">
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                                    @error('photo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kondisi">Kondisi</label>
                                    <input type="text" name="kondisi"
                                        class="form-control @error('kondisi') is-invalid @enderror"
                                        value="{{ old('kondisi', $ruangan->kondisi) }}">
                                    @error('kondisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kapasitas">Kapasitas</label>
                                    <input type="text" name="kapasitas"
                                        class="form-control @error('kapasitas') is-invalid @enderror"
                                        value="{{ old('kapasitas', $ruangan->kapasitas) }}">
                                    @error('kapasitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi"
                                        class="form-control @error('lokasi') is-invalid @enderror"
                                        value="{{ old('lokasi', $ruangan->lokasi) }}">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('kelola-ruangan.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
