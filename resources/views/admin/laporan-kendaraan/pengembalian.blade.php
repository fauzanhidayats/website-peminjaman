@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Pengembalian</h1>
        </div>

        <form action="{{ route('admin.laporan.pengembalian.kendaraan.pdf') }}" method="GET" target="_blank">
            <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
            <input type="hidden" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
            <button class="btn btn-danger mb-3">Cetak PDF</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Kendaraan</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalian as $item)
                    <tr>
                        <td>{{ $item->peminjamanKendaraan->user->username ?? '-' }}</td>
                        <td>{{ $item->peminjamanKendaraan->kendaraan->nama_kendaraan ?? '-' }}</td>
                        <td>{{ $item->tgl_dikembalikan }}</td>
                        <td>
                            @if ($item->status === 'belum')
                                <span class="badge badge-warning">Belum Dikembalikan</span>
                            @elseif ($item->status === 'dikembalikan')
                                <span class="badge badge-success">Dikembalikan</span>
                            @else
                                {{ $item->status }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data pengembalian dalam rentang tanggal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
