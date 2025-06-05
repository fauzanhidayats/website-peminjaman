@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Status Peminjaman Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.peminjaman-barang.index') }}">Peminjaman Barang</a>
                </div>
                <div class="breadcrumb-item active">Edit Status</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

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
                            <h4>Ubah Status Peminjaman Barang</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.peminjaman-barang.update', $peminjaman->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="diajukan" {{ $peminjaman->status == 'diajukan' ? 'selected' : '' }}>
                                            Diajukan</option>
                                        <option value="diterima" {{ $peminjaman->status == 'diterima' ? 'selected' : '' }}>
                                            Diterima</option>
                                        <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>
                                            Ditolak</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Nama Peminjam:</label>
                                    <p>{{ $peminjaman->user->username ?? '-' }}</p>
                                </div>

                                <div class="form-group">
                                    <label>Barang:</label>
                                    <p>{{ $peminjaman->barang->nama_barang ?? '-' }}</p>
                                </div>

                                <div class="form-group">
                                    <label>Jumlah:</label>
                                    <p>{{ $peminjaman->jumlah }}</p>
                                </div>

                                <div class="form-group">
                                    <label>Kegiatan:</label>
                                    <p>{{ $peminjaman->kegiatan ?? '-' }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="surat">Surat Peminjaman</label><br>
                                    @if ($peminjaman->surat_peminjaman)
                                        <a href="{{ asset('storage/' . $peminjaman->surat_peminjaman) }}" target="_blank"
                                            class="btn btn-outline-info btn-sm">
                                            <i class="fa fa-download"></i> Download Surat
                                        </a>
                                    @else
                                        <span class="text-muted">Belum tersedia</span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.peminjaman-barang.index') }}"
                                    class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
