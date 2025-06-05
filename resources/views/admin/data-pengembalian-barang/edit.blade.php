@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Pengembalian Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pengembalian-barang.index') }}">Pengembalian</a></div>
                <div class="breadcrumb-item active">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        {{-- Tampilkan flash message error --}}
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="card-header">
                            <h4>Form Edit Pengembalian Barang</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('pengembalian-barang.update', $pengembalian->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="peminjaman_barang_id">Peminjaman Barang</label>
                                    <select name="peminjaman_barang_id" class="form-control" disabled>
                                        <option value="{{ $pengembalian->peminjamanBarang->id }}">
                                            {{ $pengembalian->peminjamanBarang->user->username ?? '-' }} -
                                            {{ $pengembalian->peminjamanBarang->barang->nama_barang ?? '-' }}
                                        </option>
                                    </select>
                                    <input type="hidden" name="peminjaman_barang_id"
                                        value="{{ $pengembalian->peminjaman_barang_id }}">
                                </div>

                                <div class="form-group">
                                    <label for="tgl_dikembalikan">Tanggal Dikembalikan</label>
                                    <input type="date" name="tgl_dikembalikan"
                                        class="form-control @error('tgl_dikembalikan') is-invalid @enderror"
                                        value="{{ old('tgl_dikembalikan', date('Y-m-d', strtotime($pengembalian->tgl_dikembalikan))) }}"
                                        required>
                                    @error('tgl_dikembalikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_dikembalikan">Jumlah Dikembalikan</label>
                                    <input type="number" name="jumlah_dikembalikan"
                                        class="form-control @error('jumlah_dikembalikan') is-invalid @enderror"
                                        value="{{ old('jumlah_dikembalikan', $pengembalian->jumlah_dikembalikan) }}"
                                        min="1" required>
                                    @error('jumlah_dikembalikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status Pengembalian</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror"
                                        required>
                                        <option value="belum"
                                            {{ old('status', $pengembalian->status) == 'belum' ? 'selected' : '' }}>Belum
                                            Dikembalikan
                                        </option>
                                        <option value="dikembalikan"
                                            {{ old('status', $pengembalian->status) == 'dikembalikan' ? 'selected' : '' }}>
                                            Dikembalikan
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                <a href="{{ route('pengembalian-barang.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
