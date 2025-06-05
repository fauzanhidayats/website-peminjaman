<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeminjamanRuangan;
use App\Models\PengembalianRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPengembalianRuanganController extends Controller
{
    public function index()
    {
        $pengembalians = PengembalianRuangan::with('peminjamanRuangan.ruangan')->latest()->get();
        return view('admin.data-pengembalian-ruangan.index', compact('pengembalians'));
    }

    public function create()
    {
        $peminjamans = PeminjamanRuangan::with('ruangan')
            ->where('status', 'diterima')
            ->whereDoesntHave('pengembalianRuangan')
            ->get();

        return view('admin.data-pengembalian-ruangan.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_ruangan_id' => 'required|exists:peminjaman_ruangan,id',
            'tgl_dikembalikan' => 'required|date',
            'status' => 'required|in:belum,dikembalikan',
        ]);

        $status = strtolower(trim($request->status));
        $peminjaman = PeminjamanRuangan::findOrFail($request->peminjaman_ruangan_id);

        DB::transaction(function () use ($request, $status, $peminjaman) {
            PengembalianRuangan::create([
                'peminjaman_ruangan_id' => $peminjaman->id,
                'tgl_dikembalikan' => $request->tgl_dikembalikan,
                'status' => $status,
            ]);

            // Tidak update status ruangan di sini agar tidak bergantung pada kolom status ruangan
        });

        return redirect()->route('pengembalian-ruangan.index')
            ->with('success', 'Pengembalian ruangan berhasil disimpan.');
    }

    public function show($id)
    {
        $pengembalian = PengembalianRuangan::with('peminjamanRuangan.user', 'peminjamanRuangan.ruangan')->findOrFail($id);
        return view('admin.data-pengembalian-ruangan.show', compact('pengembalian'));
    }

    public function edit($id)
    {
        $pengembalian = PengembalianRuangan::with('peminjamanRuangan.ruangan')->findOrFail($id);
        return view('admin.data-pengembalian-ruangan.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_dikembalikan' => 'required|date',
            'status' => 'required|in:belum,dikembalikan',
        ]);

        $status = strtolower(trim($request->status));

        DB::transaction(function () use ($request, $id, $status) {
            $pengembalian = PengembalianRuangan::findOrFail($id);
            // Tidak update status ruangan di sini

            $pengembalian->update([
                'tgl_dikembalikan' => $request->tgl_dikembalikan,
                'status' => $status,
            ]);
        });

        return redirect()->route('pengembalian-ruangan.index')
            ->with('success', 'Data pengembalian ruangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pengembalian = PengembalianRuangan::findOrFail($id);
            // Tidak update status ruangan di sini

            $pengembalian->delete();
        });

        return redirect()->route('pengembalian-ruangan.index')
            ->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
