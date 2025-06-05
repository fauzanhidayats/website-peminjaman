<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class AjukanPinjamanRuanganController extends Controller
{
    public function create($ruangan_id)
    {
        $ruangan = Ruangan::findOrFail($ruangan_id);

        return view('peminjam.ajukan-pinjaman-ruangan.create', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangan,id',
            'kegiatan' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        $data = $request->only(['ruangan_id', 'kegiatan', 'tgl_mulai', 'tgl_selesai']);
        $data['user_id'] = Auth::id();
        $data['status'] = 'diajukan';
        $data['tgl_cetak_surat'] = now();

        $peminjaman = PeminjamanRuangan::create($data);

        // Generate PDF surat peminjaman
        $pdf = PDF::loadView('peminjam.ajukan-pinjaman-ruangan.surat-peminjaman', compact('peminjaman'));
        $fileName = 'surat_peminjaman_ruangan_' . $peminjaman->id . '.pdf';
        $filePath = 'surat_peminjaman_ruangan/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());

        $peminjaman->update(['surat_peminjaman' => $filePath]);

        return redirect()->route('peminjaman-ruangan.index')
            ->with('success', 'Peminjaman ruangan berhasil diajukan.');
    }

    public function index()
    {
        $peminjamanRuangans = PeminjamanRuangan::with('ruangan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('peminjam.ajukan-pinjaman-ruangan.index', compact('peminjamanRuangans'));
    }
}
