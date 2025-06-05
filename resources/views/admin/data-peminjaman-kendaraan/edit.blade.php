@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Status Peminjaman Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.peminjaman-kendaraan.index') }}">Peminjaman
                        Kendaraan</a>
                </div>
                <div class="breadcrumb-item active">Edit</div>
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

                    {{-- Tampilkan notifikasi sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit Status Peminjaman Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.peminjaman-kendaraan.update', $peminjaman->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <input type="text" class="form-control"
                                        value="{{ $peminjaman->user->username ?? ($peminjaman->user->name ?? '-') }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nama Kendaraan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $peminjaman->kendaraan->nama_kendaraan ?? '-' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Keperluan</label>
                                    <input type="text" class="form-control" value="{{ $peminjaman->keperluan ?? '-' }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($peminjaman->tgl_mulai)->format('d-m-Y') }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($peminjaman->tgl_selesai)->format('d-m-Y') }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="diajukan"
                                            {{ $peminjaman->status === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                        <option value="diterima"
                                            {{ $peminjaman->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="ditolak" {{ $peminjaman->status === 'ditolak' ? 'selected' : '' }}>
                                            Ditolak</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('admin.peminjaman-kendaraan.index') }}"
                                    class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
