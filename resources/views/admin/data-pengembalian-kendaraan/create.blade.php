@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pengembalian Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pengembalian-kendaraan.index') }}">Pengembalian</a></div>
                <div class="breadcrumb-item active">Tambah</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Pengembalian Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pengembalian-kendaraan.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="peminjaman_kendaraan_id">Pilih Peminjaman Kendaraan</label>
                                    <select name="peminjaman_kendaraan_id"
                                        class="form-control @error('peminjaman_kendaraan_id') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Peminjaman --</option>
                                        @foreach ($peminjamans as $peminjaman)
                                            <option value="{{ $peminjaman->id }}"
                                                {{ old('peminjaman_kendaraan_id') == $peminjaman->id ? 'selected' : '' }}>
                                                {{ $peminjaman->user->username }} -
                                                {{ $peminjaman->kendaraan->nama_kendaraan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('peminjaman_kendaraan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tgl_dikembalikan">Tanggal Dikembalikan</label>
                                    <input type="date" name="tgl_dikembalikan"
                                        class="form-control @error('tgl_dikembalikan') is-invalid @enderror"
                                        value="{{ old('tgl_dikembalikan', date('Y-m-d')) }}" required>
                                    @error('tgl_dikembalikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status Pengembalian</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror"
                                        required>
                                        <option value="belum" {{ old('status') == 'belum' ? 'selected' : '' }}>Belum
                                            Dikembalikan</option>
                                        <option value="dikembalikan"
                                            {{ old('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('pengembalian-kendaraan.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
