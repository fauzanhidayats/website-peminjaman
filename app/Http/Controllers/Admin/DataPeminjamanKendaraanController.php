<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanKendaraan;
use App\Models\Kendaraan;
use PDF;
use Carbon\Carbon;

class DataPeminjamanKendaraanController extends Controller
{
    // Tampilkan semua data peminjaman kendaraan + peminjaman aktif
    public function index()
    {
        $peminjamanKendaraans = PeminjamanKendaraan::with(['user', 'kendaraan'])->latest()->get();

        $now = Carbon::now()->toDateString();

        // Peminjaman aktif status diterima dan dalam rentang tanggal
        $peminjamanAktif = PeminjamanKendaraan::where('status', 'diterima')
            ->whereDate('tgl_mulai', '<=', $now)
            ->whereDate('tgl_selesai', '>=', $now)
            ->get()
            ->keyBy('kendaraan_id');

        return view('admin.data-peminjaman-kendaraan.index', compact('peminjamanKendaraans', 'peminjamanAktif'));
    }

    // Form edit status peminjaman
    public function edit($id)
    {
        $peminjaman = PeminjamanKendaraan::with(['user', 'kendaraan'])->findOrFail($id);
        return view('admin.data-peminjaman-kendaraan.edit', compact('peminjaman'));
    }

    // Update status peminjaman
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diterima,ditolak',
        ]);

        $peminjaman = PeminjamanKendaraan::with('kendaraan')->findOrFail($id);

        $peminjaman->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.peminjaman-kendaraan.index')
            ->with('success', 'Status peminjaman kendaraan berhasil diperbarui.');
    }

    // Download surat peminjaman PDF
    public function downloadSurat($id)
    {
        $peminjaman = PeminjamanKendaraan::with(['user', 'kendaraan'])->findOrFail($id);

        $pdf = PDF::loadView('admin.data-peminjaman-kendaraan.surat-peminjaman', compact('peminjaman'));

        return $pdf->download('surat_peminjaman_kendaraan_' . $peminjaman->id . '.pdf');
    }
}
