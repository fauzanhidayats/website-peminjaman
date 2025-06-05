@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjaman Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item active">Peminjaman Kendaraan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Peminjam</th>
                                            <th>Kendaraan</th>
                                            <th>Keperluan</th>
                                            <th>Tgl Mulai</th>
                                            <th>Tgl Selesai</th>
                                            <th>Status</th>
                                            <th>Surat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($peminjamanKendaraans as $index => $item)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $item->user->username ?? ($item->user->name ?? '-') }}</td>
                                                <td>{{ $item->kendaraan->nama_kendaraan ?? '-' }}</td>
                                                <td>{{ $item->keperluan ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d-m-Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $item->status === 'diajukan' ? 'warning' : ($item->status === 'diterima' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($item->surat_peminjaman)
                                                        <a href="{{ route('admin.peminjaman-kendaraan.surat', $item->id) }}"
                                                            class="btn btn-sm btn-outline-info" target="_blank">
                                                            <i class="fa fa-download"></i> Surat
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Belum tersedia</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.peminjaman-kendaraan.edit', $item->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted">Belum ada data peminjaman
                                                    kendaraan.</td>
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
