<?php

namespace App\Http\Controllers\Admin;

use App\Models\PeminjamanBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class DataPeminjamanBarangController extends Controller
{
    // Tampilkan semua data peminjaman barang
    public function index()
    {
        $peminjamanBarangs = PeminjamanBarang::with(['user', 'barang'])->latest()->get();
        return view('admin.data-peminjaman-barang.index', compact('peminjamanBarangs'));
    }

    // Form ubah status
    public function edit($id)
    {
        $peminjaman = PeminjamanBarang::with(['user', 'barang'])->findOrFail($id);
        return view('admin.data-peminjaman-barang.edit', compact('peminjaman'));
    }

    // Simpan perubahan status dan kelola stok
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diterima,ditolak',
        ]);

        $peminjaman = PeminjamanBarang::with('barang')->findOrFail($id);
        $barang = $peminjaman->barang;

        if ($peminjaman->status !== $request->status) {

            // Jika berubah dari diajukan → diterima
            if ($peminjaman->status === 'diajukan' && $request->status === 'diterima') {
                if ($peminjaman->jumlah > $barang->stok) {
                    return back()->withInput()->with('error', 'Stok barang tidak mencukupi.');
                }
                $barang->stok -= $peminjaman->jumlah;
                $barang->save();
            }

            // Jika berubah dari diterima → diajukan
            if ($peminjaman->status === 'diterima' && $request->status === 'diajukan') {
                $barang->stok += $peminjaman->jumlah;
                $barang->save();
            }

            // Jika berubah ke ditolak, dan sebelumnya diterima, kembalikan stok
            if ($request->status === 'ditolak' && $peminjaman->status === 'diterima') {
                $barang->stok += $peminjaman->jumlah;
                $barang->save();
            }
        }

        $peminjaman->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.peminjaman-barang.index')
            ->with('success', 'Status berhasil diperbarui.');
    }

    // Download surat peminjaman
    public function downloadSurat($id)
    {
        $peminjaman = PeminjamanBarang::with(['user', 'barang'])->findOrFail($id);

        $pdf = PDF::loadView('admin.data-peminjaman-barang.surat-peminjaman', compact('peminjaman'));

        return $pdf->download('surat_peminjaman_barang_' . $peminjaman->id . '.pdf');
    }
}
