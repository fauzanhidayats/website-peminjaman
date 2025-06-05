<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use PDF;
use Carbon\Carbon;

class DataPeminjamanRuanganController extends Controller
{
    // Tampilkan semua data peminjaman ruangan sekaligus data peminjaman aktif untuk card
    public function index()
    {
        $peminjamanRuangans = PeminjamanRuangan::with(['user', 'ruangan'])->latest()->get();

        $now = Carbon::now()->toDateString();

        $peminjamanAktif = PeminjamanRuangan::where('status', 'diterima')
            ->whereDate('tgl_mulai', '<=', $now)
            ->whereDate('tgl_selesai', '>=', $now)
            ->get()
            ->keyBy('ruangan_id');

        return view('admin.data-peminjaman-ruangan.index', compact('peminjamanRuangans', 'peminjamanAktif'));
    }

    // Form ubah status peminjaman ruangan
    public function edit($id)
    {
        $peminjaman = PeminjamanRuangan::with(['user', 'ruangan'])->findOrFail($id);
        return view('admin.data-peminjaman-ruangan.edit', compact('peminjaman'));
    }

    // Simpan perubahan status peminjaman ruangan
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diterima,ditolak',
        ]);

        $peminjaman = PeminjamanRuangan::findOrFail($id);

        // Update status peminjaman ruangan langsung tanpa menyentuh ruangan
        $peminjaman->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.peminjaman-ruangan.index')
            ->with('success', 'Status peminjaman ruangan berhasil diperbarui.');
    }

    // Download surat peminjaman ruangan
    public function downloadSurat($id)
    {
        $peminjaman = PeminjamanRuangan::with(['user', 'ruangan'])->findOrFail($id);

        $pdf = PDF::loadView('admin.data-peminjaman-ruangan.surat-peminjaman', compact('peminjaman'));

        return $pdf->download('surat_peminjaman_ruangan_' . $peminjaman->id . '.pdf');
    }
}
