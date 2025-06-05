@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan</h1>
        </div>

        <div class="row">
            {{-- Form Laporan Peminjaman --}}
            <div class="col-md-6">
                <h4>Laporan Peminjaman</h4>
                <form action="{{ route('admin.laporan.peminjaman.ruangan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal_mulai_peminjaman">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai_peminjaman" name="tanggal_mulai" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai_peminjaman">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai_peminjaman" name="tanggal_selesai" class="form-control"
                            required>
                    </div>
                    <button class="btn btn-primary">Lihat Laporan</button>
                </form>
            </div>

            {{-- Form Laporan Pengembalian --}}
            <div class="col-md-6">
                <h4>Laporan Pengembalian</h4>
                <form action="{{ route('admin.laporan.pengembalian.ruangan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal_mulai_pengembalian">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai_pengembalian" name="tanggal_mulai" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai_pengembalian">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai_pengembalian" name="tanggal_selesai" class="form-control"
                            required>
                    </div>
                    <button class="btn btn-success">Lihat Laporan</button>
                </form>
            </div>
        </div>
    </section>
@endsection
