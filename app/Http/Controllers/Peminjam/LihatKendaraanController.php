<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\PeminjamanKendaraan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LihatKendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::latest()->get();
        $now = Carbon::now()->toDateString();

        // Ambil semua peminjaman kendaraan yang statusnya diterima dan periode aktif
        $peminjamanAktif = PeminjamanKendaraan::with('pengembalianKendaraan')
            ->where('status', 'diterima')
            ->whereDate('tgl_mulai', '<=', $now)
            ->whereDate('tgl_selesai', '>=', $now)
            ->get()
            ->keyBy('kendaraan_id');

        return view('peminjam.lihat-kendaraan.index', compact('kendaraans', 'peminjamanAktif'));
    }
}
