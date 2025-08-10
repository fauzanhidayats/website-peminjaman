<?php

namespace App\Http\Controllers\Peminjam;

use Illuminate\Http\Request;
use App\Models\PengembalianBarang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataPengembalianBarangController extends Controller
{
    public function index()
    {
        $pengembalians = PengembalianBarang::whereHas('peminjamanBarang', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->with(['peminjamanBarang.user', 'peminjamanBarang.barang'])
            ->latest()
            ->get();

        return view('peminjam.data-pengembalian-barang.index', compact('pengembalians'));
    }

    public function show($id)
    {
        $pengembalian = PengembalianBarang::with('peminjamanBarang.user', 'peminjamanBarang.barang')
            ->whereHas('peminjamanBarang', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->findOrFail($id);

        return view('peminjam.data-pengembalian-barang.detail', compact('pengembalian'));
    }
}
