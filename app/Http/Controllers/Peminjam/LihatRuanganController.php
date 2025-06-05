<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use App\Models\PeminjamanRuangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LihatRuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::latest()->get();
        $now = Carbon::now()->toDateString();

        // Ambil semua peminjaman yang statusnya diterima dan periode aktif
        $peminjamanAktif = PeminjamanRuangan::with('pengembalianRuangan')
            ->where('status', 'diterima')
            ->whereDate('tgl_mulai', '<=', $now)
            ->whereDate('tgl_selesai', '>=', $now)
            ->get()
            ->keyBy('ruangan_id');

        return view('peminjam.lihat-ruangan.index', compact('ruangans', 'peminjamanAktif'));
    }
}
