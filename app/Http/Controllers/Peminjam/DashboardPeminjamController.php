<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Kendaraan;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanKendaraan;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;

class DashboardPeminjamController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalRuangan = Ruangan::count();
        $totalKendaraan = Kendaraan::count();

        $totalPeminjamanBarang = PeminjamanBarang::where('user_id', Auth::id())->count();
        $totalPeminjamanRuangan = PeminjamanRuangan::where('user_id', Auth::id())->count();
        $totalPeminjamanKendaraan = PeminjamanKendaraan::where('user_id', Auth::id())->count();

        return view('peminjam.index', compact(
            'totalBarang',
            'totalRuangan',
            'totalKendaraan',
            'totalPeminjamanBarang',
            'totalPeminjamanRuangan',
            'totalPeminjamanKendaraan'
        ));
    }
}
