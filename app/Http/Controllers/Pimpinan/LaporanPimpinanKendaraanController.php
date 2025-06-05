<?php

namespace App\Http\Controllers\Pimpinan;

use PDF;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PeminjamanKendaraan;
use App\Models\PengembalianKendaraan;

class LaporanPimpinanKendaraanController extends Controller
{
    public function index()
    {
        return view('pimpinan.laporan-kendaraan.index');
    }

    public function laporanPeminjamanKendaraan(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $peminjaman = PeminjamanKendaraan::whereBetween('tgl_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['user', 'kendaraan']) // relasi yang sesuai
            ->get();

        return view('pimpinan.laporan-kendaraan.peminjaman', compact('peminjaman'));
    }

    public function laporanPengembalianKendaraan(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pengembalian = PengembalianKendaraan::whereBetween('tgl_dikembalikan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['peminjamanKendaraan.user', 'peminjamanKendaraan.kendaraan']) // ambil data peminjaman dan user/barang-nya
            ->get();

        return view('pimpinan.laporan-kendaraan.pengembalian', compact('pengembalian'));
    }

    public function cetakPeminjamanKendaraanPDF(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $peminjaman = PeminjamanKendaraan::whereBetween('tgl_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['user', 'kendaraan'])
            ->get();

        $pdf = PDF::loadView('pimpinan.laporan-kendaraan.pdf_peminjaman', [
            'peminjaman' => $peminjaman,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return $pdf->download('laporan_peminjaman-kendaraan.pdf');
    }

    public function cetakPengembalianKendaraanPDF(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pengembalian = PengembalianKendaraan::whereBetween('tgl_dikembalikan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['peminjamanKendaraan.user', 'peminjamanKendaraan.kendaraan'])
            ->get();

        $pdf = PDF::loadView('pimpinan.laporan-kendaraan.pdf_pengembalian', [
            'pengembalian' => $pengembalian,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return $pdf->download('laporan_pengembalian-kendaraan.pdf');
    }
}
