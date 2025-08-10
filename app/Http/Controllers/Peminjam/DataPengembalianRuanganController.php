<?php

namespace App\Http\Controllers\Peminjam;

use Illuminate\Http\Request;
use App\Models\PengembalianRuangan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataPengembalianRuanganController extends Controller
{
    public function index()
    {
        $pengembalians = PengembalianRuangan::whereHas('peminjamanRuangan', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->with(['peminjamanRuangan.user', 'peminjamanRuangan.ruangan'])
            ->latest()
            ->get();

        return view('peminjam.data-pengembalian-ruangan.index', compact('pengembalians'));
    }

    public function show($id)
    {
        $pengembalian = PengembalianRuangan::with('peminjamanRuangan.user', 'peminjamanRuangan.ruangan')
            ->whereHas('peminjamanRuangan', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->findOrFail($id);

        return view('peminjam.data-pengembalian-ruangan.detail', compact('pengembalian'));
    }
}
