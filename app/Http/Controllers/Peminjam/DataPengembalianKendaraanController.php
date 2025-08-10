<?php

namespace App\Http\Controllers\Peminjam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PengembalianKendaraan;

class DataPengembalianKendaraanController extends Controller
{
    public function index()
    {
        $pengembalians = PengembalianKendaraan::whereHas('peminjamanKendaraan', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->with(['peminjamanKendaraan.user', 'peminjamanKendaraan.kendaraan'])
            ->latest()
            ->get();

        return view('peminjam.data-pengembalian-kendaraan.index', compact('pengembalians'));
    }

    public function show($id)
    {
        $pengembalian = PengembalianKendaraan::with('peminjamanKendaraan.user', 'peminjamanKendaraan.kendaraan')
            ->whereHas('peminjamanKendaraan', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->findOrFail($id);

        return view('peminjam.data-pengembalian-kendaraan.detail', compact('pengembalian'));
    }
}
