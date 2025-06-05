@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Ruangan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Ruangan</div>
            </div>
        </div>

        <div class="row">
            @forelse($ruangans as $ruangan)
                @php
                    $peminjaman = $peminjamanAktif->get($ruangan->id) ?? null;

                    $sudahDikembalikan = false;

                    if (
                        $peminjaman &&
                        $peminjaman->pengembalianRuangan &&
                        $peminjaman->pengembalianRuangan->status === 'dikembalikan'
                    ) {
                        $sudahDikembalikan = true;
                    }
                @endphp

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100 shadow border-0">
                        <div class="card-img-top-wrapper" style="height: 200px; overflow: hidden;">
                            @if ($ruangan->photo)
                                <img src="{{ asset('storage/' . $ruangan->photo) }}" class="card-img-top"
                                    alt="{{ $ruangan->nama_ruangan }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="No Image"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $ruangan->nama_ruangan }}</h5>
                            <p class="card-text mb-1"><strong>Kondisi:</strong> {{ $ruangan->kondisi ?? '-' }}</p>
                            <p class="card-text mb-1"><strong>Kapasitas:</strong> {{ $ruangan->kapasitas ?? '-' }}</p>
                            <p class="card-text mb-1"><strong>Lokasi:</strong> {{ $ruangan->lokasi ?? '-' }}</p>

                            <p class="card-text mb-3"><strong>Status:</strong>
                                @if ($peminjaman && !$sudahDikembalikan)
                                    <span class="badge badge-danger">
                                        Sedang Dipinjam<br>
                                        {{ \Carbon\Carbon::parse($peminjaman->tgl_mulai)->format('d-m-Y') }}
                                        sampai
                                        {{ \Carbon\Carbon::parse($peminjaman->tgl_selesai)->format('d-m-Y') }}
                                    </span>
                                @else
                                    <span class="badge badge-success">Tersedia</span>
                                @endif
                            </p>

                            {{-- Tombol Ajukan Pinjaman --}}
                            @if (!$peminjaman || $sudahDikembalikan)
                                <a href="{{ route('peminjaman-ruangan.create', $ruangan->id) }}"
                                    class="btn btn-primary mt-auto">
                                    Ajukan Pinjaman
                                </a>
                            @else
                                <button class="btn btn-secondary mt-auto" disabled>
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada ruangan yang tersedia.</div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
