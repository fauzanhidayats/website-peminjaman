<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\PeminjamanBarang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class AjukanPinjamanBarangController extends Controller
{
    // Tampilkan form ajukan pinjaman barang
    public function create($barang_id)
    {
        $barang = Barang::findOrFail($barang_id);

        // Hapus pengecekan status barang, biar tidak tergantung status
        // Validasi stok tetap dilakukan di store

        return view('peminjam.ajukan-pinjaman-barang.create', compact('barang'));
    }

    // Simpan pengajuan pinjaman barang
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'kegiatan' => 'required|string|max:255',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Validasi stok barang harus cukup
        if ($request->jumlah > $barang->stok) {
            return redirect()->back()->withInput()->with('error', 'Stok barang tidak mencukupi.');
        }

        // Siapkan data untuk simpan peminjaman
        $data = $request->only(['barang_id', 'jumlah', 'kegiatan', 'tgl_pinjam', 'tgl_kembali']);
        $data['user_id'] = Auth::id();
        $data['status'] = 'diajukan';
        $data['tgl_cetak_surat'] = now();

        // Simpan data peminjaman barang
        $peminjaman = PeminjamanBarang::create($data);

        // Generate surat peminjaman sebagai PDF
        $pdf = PDF::loadView('peminjam.ajukan-pinjaman-barang.surat-peminjaman', compact('peminjaman'));
        $fileName = 'surat_peminjaman_barang_' . $peminjaman->id . '.pdf';
        $pdfPath = 'surat_peminjaman_barang/' . $fileName;

        // Simpan file PDF ke storage public
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Update path surat peminjaman ke database
        $peminjaman->update(['surat_peminjaman' => $pdfPath]);

        return redirect()->route('peminjaman-barang.index')
            ->with('success', 'Peminjaman barang berhasil diajukan dan surat berhasil dibuat.');
    }

    // Tampilkan list peminjaman barang user
    public function index()
    {
        $peminjamanBarangs = PeminjamanBarang::where('user_id', Auth::id())
            ->latest()
            ->with('barang')
            ->get();

        return view('peminjam.ajukan-pinjaman-barang.index', compact('peminjamanBarangs'));
    }
}
