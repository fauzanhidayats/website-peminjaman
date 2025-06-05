<?php

namespace App\Http\Controllers\Pimpinan;

use PDF;
use App\Models\PeminjamanBarang;
use App\Models\PengembalianBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanPimpinanBarangController extends Controller
{
    public function index()
    {
        return view('pimpinan.laporan-barang.index');
    }

    public function laporanPeminjamanBarang(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $peminjaman = PeminjamanBarang::whereBetween('tgl_pinjam', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['user', 'barang']) // relasi yang sesuai
            ->get();

        return view('pimpinan.laporan-barang.peminjaman', compact('peminjaman'));
    }

    public function laporanPengembalianBarang(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pengembalian = PengembalianBarang::whereBetween('tgl_dikembalikan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['peminjamanBarang.user', 'peminjamanBarang.barang']) // ambil data peminjaman dan user/barang-nya
            ->get();

        return view('pimpinan.laporan-barang.pengembalian', compact('pengembalian'));
    }

    public function cetakPeminjamanBarangPDF(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $peminjaman = PeminjamanBarang::whereBetween('tgl_pinjam', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['user', 'barang'])
            ->get();

        $pdf = PDF::loadView('pimpinan.laporan-barang.pdf_peminjaman', [
            'peminjaman' => $peminjaman,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return $pdf->download('laporan_peminjaman-barang.pdf');
    }

    public function cetakPengembalianBarangPDF(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pengembalian = PengembalianBarang::whereBetween('tgl_dikembalikan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->with(['peminjamanBarang.user', 'peminjamanBarang.barang'])
            ->get();

        $pdf = PDF::loadView('pimpinan.laporan-barang.pdf_pengembalian', [
            'pengembalian' => $pengembalian,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return $pdf->download('laporan_pengembalian-barang.pdf');
    }
}
