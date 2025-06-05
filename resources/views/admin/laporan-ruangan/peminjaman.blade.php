@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Peminjaman</h1>
        </div>

        <form action="{{ route('admin.laporan.peminjaman.ruangan.pdf') }}" method="GET" target="_blank">
            <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
            <input type="hidden" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
            <button class="btn btn-danger mb-3">Cetak PDF</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Ruangan</th>
                    <th>Kegiatan</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjaman as $item)
                    <tr>
                        <td>{{ $item->user->username ?? '-' }}</td>
                        <td>{{ $item->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ $item->kegiatan ?? '-' }}</td>
                        <td>{{ $item->tgl_mulai }}</td>
                        <td>{{ $item->tgl_selesai }}</td>
                        <td>
                            @if ($item->status === 'diajukan')
                                <span class="badge badge-warning">Diajukan</span>
                            @elseif ($item->status === 'diterima')
                                <span class="badge badge-success">Diterima</span>
                            @elseif ($item->status === 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                {{ $item->status }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data peminjaman dalam rentang tanggal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
