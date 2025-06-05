@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjaman Ruangan Saya</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Peminjaman Ruangan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    @if (session('error'))
                        <div class="alert alert-success">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('peminjaman-ruangan.index') }}" class="btn btn-primary">Ajukan Peminjaman</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Ruangan</th>
                                            <th>Kegiatan</th>
                                            <th>Tgl Mulai</th>
                                            <th>Tgl Selesai</th>
                                            <th>Status</th>
                                            <th>Surat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($peminjamanRuangans as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->ruangan->nama_ruangan ?? '-' }}</td>
                                                <td>{{ $item->kegiatan ?? '-' }}</td>
                                                <td>{{ $item->tgl_mulai }}</td>
                                                <td>{{ $item->tgl_selesai }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $item->status === 'diajukan' ? 'warning' : ($item->status === 'diterima' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($item->surat_peminjaman)
                                                        <a href="{{ asset('storage/' . $item->surat_peminjaman) }}"
                                                            target="_blank" class="btn btn-sm btn-outline-info">
                                                            <i class="fa fa-download"></i> Surat
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Belum tersedia</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    Belum ada pengajuan peminjaman.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
