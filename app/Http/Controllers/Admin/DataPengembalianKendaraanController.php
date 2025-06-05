<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeminjamanKendaraan;
use App\Models\PengembalianKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPengembalianKendaraanController extends Controller
{
    public function index()
    {
        $pengembalians = PengembalianKendaraan::with('peminjamanKendaraan.kendaraan')->latest()->get();
        return view('admin.data-pengembalian-kendaraan.index', compact('pengembalians'));
    }

    public function create()
    {
        $peminjamans = PeminjamanKendaraan::with('kendaraan')
            ->where('status', 'diterima')
            ->whereDoesntHave('pengembalianKendaraan')
            ->get();

        return view('admin.data-pengembalian-kendaraan.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_kendaraan_id' => 'required|exists:peminjaman_kendaraan,id',
            'tgl_dikembalikan' => 'required|date',
            'status' => 'required|in:belum,dikembalikan',
        ]);

        $status = strtolower(trim($request->status));
        $peminjaman = PeminjamanKendaraan::findOrFail($request->peminjaman_kendaraan_id);

        DB::transaction(function () use ($request, $status, $peminjaman) {
            PengembalianKendaraan::create([
                'peminjaman_kendaraan_id' => $peminjaman->id,
                'tgl_dikembalikan' => $request->tgl_dikembalikan,
                'status' => $status,
            ]);

            // Tidak update status kendaraan di sini, agar tidak bergantung pada kolom status kendaraan
        });

        return redirect()->route('pengembalian-kendaraan.index')
            ->with('success', 'Pengembalian kendaraan berhasil disimpan.');
    }

    public function show($id)
    {
        $pengembalian = PengembalianKendaraan::with('peminjamanKendaraan.user', 'peminjamanKendaraan.kendaraan')->findOrFail($id);
        return view('admin.data-pengembalian-kendaraan.show', compact('pengembalian'));
    }

    public function edit($id)
    {
        $pengembalian = PengembalianKendaraan::with('peminjamanKendaraan.kendaraan')->findOrFail($id);
        return view('admin.data-pengembalian-kendaraan.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_dikembalikan' => 'required|date',
            'status' => 'required|in:belum,dikembalikan',
        ]);

        $status = strtolower(trim($request->status));

        DB::transaction(function () use ($request, $id, $status) {
            $pengembalian = PengembalianKendaraan::findOrFail($id);
            // Tidak update status kendaraan agar tidak bergantung ke kolom status kendaraan

            $pengembalian->update([
                'tgl_dikembalikan' => $request->tgl_dikembalikan,
                'status' => $status,
            ]);
        });

        return redirect()->route('pengembalian-kendaraan.index')
            ->with('success', 'Data pengembalian kendaraan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pengembalian = PengembalianKendaraan::findOrFail($id);
            // Tidak update status kendaraan agar tidak bergantung ke kolom status kendaraan

            $pengembalian->delete();
        });

        return redirect()->route('pengembalian-kendaraan.index')
            ->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
