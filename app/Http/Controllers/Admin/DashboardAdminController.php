<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Kendaraan;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use App\Models\PeminjamanKendaraan;
use App\Models\PengembalianBarang;
use App\Models\PengembalianRuangan;
use App\Models\PengembalianKendaraan;



class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBarang = Barang::count();
        $totalRuangan = Ruangan::count();
        $totalKendaraan = Kendaraan::count();

        $totalPeminjamanBarang = PeminjamanBarang::count();
        $totalPeminjamanRuangan = PeminjamanRuangan::count();
        $totalPeminjamanKendaraan = PeminjamanKendaraan::count();

        $totalPengembalianBarang = PengembalianBarang::count();
        $totalPengembalianRuangan = PengembalianRuangan::count();
        $totalPengembalianKendaraan = PengembalianKendaraan::count();

        return view('admin.index', compact(
            'totalUsers',
            'totalBarang',
            'totalRuangan',
            'totalKendaraan',
            'totalPeminjamanBarang',
            'totalPeminjamanRuangan',
            'totalPeminjamanKendaraan',
            'totalPengembalianBarang',
            'totalPengembalianRuangan',
            'totalPengembalianKendaraan'
        ));
    }
}
