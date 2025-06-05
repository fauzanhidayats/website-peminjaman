<?php

namespace App\Http\Controllers\Pimpinan;

use PDF;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PeminjamanRuangan;
use App\Models\PengembalianRuangan;

class LaporanPimpinanRuanganController extends Controller
{
    public function index()
    {
        return view('pimpinan.laporan-ruangan.index');
    }

    public function laporanPeminjamanRuangan(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $peminjaman = PeminjamanRuangan::whereBetween('tgl_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['user', 'ruangan']) // relasi yang sesuai
            ->get();

        return view('pimpinan.laporan-ruangan.peminjaman', compact('peminjaman'));
    }

    public function laporanPengembalianRuangan(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pengembalian = PengembalianRuangan::whereBetween('tgl_dikembalikan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['peminjamanRuangan.user', 'peminjamanRuangan.ruangan']) // ambil data peminjaman dan user/barang-nya
            ->get();

        return view('pimpinan.laporan-ruangan.pengembalian', compact('pengembalian'));
    }

    public function cetakPeminjamanRuanganPDF(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $peminjaman = PeminjamanRuangan::whereBetween('tgl_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['user', 'ruangan'])
            ->get();

        $pdf = PDF::loadView('pimpinan.laporan-ruangan.pdf_peminjaman', [
            'peminjaman' => $peminjaman,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return $pdf->download('laporan_peminjaman-ruangan.pdf');
    }

    public function cetakPengembalianRuanganPDF(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pengembalian = PengembalianRuangan::whereBetween('tgl_dikembalikan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['peminjamanRuangan.user', 'peminjamanRuangan.ruangan'])
            ->get();

        $pdf = PDF::loadView('pimpinan.laporan-ruangan.pdf_pengembalian', [
            'pengembalian' => $pengembalian,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return $pdf->download('laporan_pengembalian-ruangan.pdf');
    }
}
