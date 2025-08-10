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

        // Ambil peminjaman yang dimaksud
        $peminjaman = PeminjamanBarang::with('barang')->findOrFail($id);
        $barang = $peminjaman->barang;

        // Cek apakah ada peminjaman lain untuk barang yang sama,
        // dengan status diajukan dan waktu lebih awal
        $adaYangLebihDulu = PeminjamanBarang::where('barang_id', $peminjaman->barang_id)
            ->where('status', 'diajukan')
            ->where('created_at', '<', $peminjaman->created_at)
            ->exists();

        // Kalau ada peminjaman yang lebih awal dan belum diproses, tolak update status
        if ($adaYangLebihDulu) {
            return back()->with('error', 'Tidak bisa memproses peminjaman ini karena masih ada pemohon sebelumnya yang belum diproses.');
        }

        // Proses perubahan stok jika status berubah
        if ($peminjaman->status !== $request->status) {

            // Jika dari diajukan → diterima
            if ($peminjaman->status === 'diajukan' && $request->status === 'diterima') {
                if ($peminjaman->jumlah > $barang->stok) {
                    return back()->withInput()->with('error', 'Stok barang tidak mencukupi.');
                }
                $barang->stok -= $peminjaman->jumlah;
                $barang->save();
            }

            // Jika dari diterima → diajukan (batal proses)
            if ($peminjaman->status === 'diterima' && $request->status === 'diajukan') {
                $barang->stok += $peminjaman->jumlah;
                $barang->save();
            }

            // Jika ditolak dan sebelumnya diterima, kembalikan stok
            if ($request->status === 'ditolak' && $peminjaman->status === 'diterima') {
                $barang->stok += $peminjaman->jumlah;
                $barang->save();
            }
        }

        // Simpan perubahan status
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
