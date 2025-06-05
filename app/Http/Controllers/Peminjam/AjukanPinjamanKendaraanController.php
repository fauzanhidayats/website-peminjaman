<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanKendaraan;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class AjukanPinjamanKendaraanController extends Controller
{
    // Tampilkan form pengajuan pinjaman kendaraan
    public function create($kendaraan_id)
    {
        $kendaraan = Kendaraan::findOrFail($kendaraan_id);

        // Hapus cek status kendaraan agar tidak tergantung status
        // Validasi ketersediaan kendaraan bisa dilakukan di admin saat approve

        return view('peminjam.ajukan-pinjaman-kendaraan.create', compact('kendaraan'));
    }

    // Simpan pengajuan pinjaman kendaraan
    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'keperluan' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        $data = $request->only(['kendaraan_id', 'keperluan', 'tgl_mulai', 'tgl_selesai']);
        $data['user_id'] = Auth::id();
        $data['status'] = 'diajukan';
        $data['tgl_cetak_surat'] = now();

        $peminjaman = PeminjamanKendaraan::create($data);

        // Generate PDF surat pengajuan pinjaman
        $pdf = PDF::loadView('peminjam.ajukan-pinjaman-kendaraan.surat-peminjaman', compact('peminjaman'));
        $fileName = 'surat_peminjaman_kendaraan_' . $peminjaman->id . '.pdf';
        $filePath = 'surat_peminjaman_kendaraan/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());

        $peminjaman->update(['surat_peminjaman' => $filePath]);

        return redirect()->route('peminjaman-kendaraan.index')
            ->with('success', 'Peminjaman kendaraan berhasil diajukan.');
    }

    // Tampilkan daftar peminjaman kendaraan user
    public function index()
    {
        $peminjamanKendaraans = PeminjamanKendaraan::where('user_id', Auth::id())
            ->latest()
            ->with('kendaraan')
            ->get();

        return view('peminjam.ajukan-pinjaman-kendaraan.index', compact('peminjamanKendaraans'));
    }
}
