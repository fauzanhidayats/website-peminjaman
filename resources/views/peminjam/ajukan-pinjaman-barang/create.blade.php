@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ajukan Peminjaman Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Peminjaman</a></div>
                <div class="breadcrumb-item active">Ajukan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    {{-- Tampilkan flash message error --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Form Pengajuan Peminjaman Barang</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('peminjaman-barang.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                                <div class="form-group">
                                    <label for="nama_barang">Barang</label>
                                    <input type="text" class="form-control" value="{{ $barang->nama_barang }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}"
                                        required ">
                                        </div>

                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" name="kegiatan" class="form-control" value="{{ old('kegiatan') }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_pinjam">Tanggal Peminjaman</label>
                                            <input type="date" name="tgl_pinjam" class="form-control"
                                                value="{{ old('tgl_pinjam') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_kembali">Tanggal Pengembalian</label>
                                            <input type="date" name="tgl_kembali" class="form-control"
                                                value="{{ old('tgl_kembali') }}" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Ajukan</button>
                                        <a href="{{ route('peminjaman-barang.index') }}" class="btn btn-secondary">Kembali</a>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
@endsection
