@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Barang</div>
            </div>
        </div>

        <div class="row">
            @forelse($barangs as $barang)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100 shadow border-0">
                        <div class="card-img-top-wrapper" style="height: 200px; overflow: hidden;">
                            @if ($barang->photo)
                                <img src="{{ asset('storage/' . $barang->photo) }}" class="card-img-top"
                                    alt="{{ $barang->nama_barang }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="No Image"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                            <p class="card-text mb-1"><strong>Kondisi:</strong> {{ $barang->kondisi ?? '-' }}</p>
                            <p class="card-text mb-1"><strong>Lokasi:</strong> {{ $barang->lokasi ?? '-' }}</p>
                            <p class="card-text mb-1"><strong>Stok:</strong> {{ $barang->stok }}</p>
                            <p class="card-text mb-3"><strong>Status:</strong>
                                @if ($barang->stok > 0)
                                    <span class="badge badge-success">Tersedia</span>
                                @else
                                    <span class="badge badge-danger">Habis</span>
                                @endif
                            </p>

                            {{-- Tombol Ajukan Pinjaman --}}
                            @if ($barang->stok > 0)
                                <a href="{{ route('peminjaman-barang.create', $barang->id) }}"
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
                    <div class="alert alert-info">Belum ada barang yang tersedia.</div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
