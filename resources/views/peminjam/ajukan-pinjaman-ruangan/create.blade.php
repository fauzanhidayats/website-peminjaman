@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ajukan Peminjaman Ruangan</h1>
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
                            <h4>Form Pengajuan Peminjaman Ruangan</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('peminjaman-ruangan.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}">

                                <div class="form-group">
                                    <label for="nama_ruangan">Ruangan</label>
                                    <input type="text" class="form-control" value="{{ $ruangan->nama_ruangan }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label for="kegiatan">Nama Kegiatan</label>
                                    <input type="text" name="kegiatan" class="form-control" value="{{ old('kegiatan') }}"
                                        required>
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
                                <a href="{{ route('peminjaman-ruangan.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
