<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeminjamanBarang;
use App\Models\PengembalianBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPengembalianBarangController extends Controller
{
    public function index()
    {
        $pengembalians = PengembalianBarang::with('peminjamanBarang')->latest()->get();

        return view('admin.data-pengembalian-barang.index', compact('pengembalians'));
    }

    public function create()
    {
        // Ambil peminjaman dengan status diterima dan belum ada pengembalian
        $peminjamans = PeminjamanBarang::with('barang')
            ->where('status', 'diterima')
            ->whereDoesntHave('pengembalianBarang')
            ->get();

        return view('admin.data-pengembalian-barang.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_barang_id' => 'required|exists:peminjaman_barang,id',
            'jumlah_dikembalikan' => 'required|integer|min:1',
            'tgl_dikembalikan' => 'required|date',
            'status' => 'required|in:belum,dikembalikan',
        ]);

        $status = strtolower($request->status);
        $peminjaman = PeminjamanBarang::findOrFail($request->peminjaman_barang_id);
        $barang = $peminjaman->barang;

        if ($request->jumlah_dikembalikan > $peminjaman->jumlah) {
            return redirect()->back()->withInput()->with('error', 'Jumlah pengembalian melebihi jumlah yang dipinjam.');
        }

        DB::transaction(function () use ($request, $status, $peminjaman, $barang) {
            PengembalianBarang::create([
                'peminjaman_barang_id' => $peminjaman->id,
                'jumlah_dikembalikan' => $request->jumlah_dikembalikan,
                'tgl_dikembalikan' => $request->tgl_dikembalikan,
                'status' => $status,
            ]);

            if ($status === 'dikembalikan') {
                // Hanya update stok tanpa ubah kolom status barang
                $barang->stok += $request->jumlah_dikembalikan;
                $barang->save();

                if ($peminjaman->status !== 'diterima') {
                    $peminjaman->status = 'diterima';
                    $peminjaman->save();
                }
            }
        });

        return redirect()->route('pengembalian-barang.index')->with('success', 'Data pengembalian berhasil disimpan.');
    }

    public function show($id)
    {
        $pengembalian = PengembalianBarang::with('peminjamanBarang.user', 'peminjamanBarang.barang')
            ->findOrFail($id);

        return view('admin.data-pengembalian-barang.detail', compact('pengembalian'));
    }

    public function edit($id)
    {
        $pengembalian = PengembalianBarang::with('peminjamanBarang.barang')->findOrFail($id);

        return view('admin.data-pengembalian-barang.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_dikembalikan' => 'required|integer|min:1',
            'tgl_dikembalikan' => 'required|date',
            'status' => 'required|in:belum,dikembalikan',
        ]);

        $status = strtolower($request->status);
        $pengembalian = PengembalianBarang::findOrFail($id);
        $peminjaman = $pengembalian->peminjamanBarang;
        $barang = $peminjaman->barang;

        if ($request->jumlah_dikembalikan > $peminjaman->jumlah) {
            return redirect()->back()->withInput()->with('error', 'Jumlah pengembalian melebihi jumlah yang dipinjam.');
        }

        DB::transaction(function () use ($request, $pengembalian, $peminjaman, $barang, $status) {
            $diff = $request->jumlah_dikembalikan - $pengembalian->jumlah_dikembalikan;

            if ($pengembalian->status !== 'dikembalikan' && $status === 'dikembalikan') {
                // Update stok barang (tambah)
                $barang->stok += $request->jumlah_dikembalikan;
                $barang->save();

                if ($peminjaman->status !== 'diterima') {
                    $peminjaman->status = 'diterima';
                    $peminjaman->save();
                }
            } elseif ($pengembalian->status === 'dikembalikan' && $status === 'belum') {
                // Kurangi stok barang (koreksi)
                $barang->stok = max(0, $barang->stok - $pengembalian->jumlah_dikembalikan);
                $barang->save();

                if ($peminjaman->status !== 'diterima') {
                    $peminjaman->status = 'diterima';
                    $peminjaman->save();
                }
            } elseif ($pengembalian->status === 'dikembalikan' && $status === 'dikembalikan') {
                // Jumlah berubah, koreksi stok
                $barang->stok += $diff;
                $barang->save();
            }

            $pengembalian->update([
                'jumlah_dikembalikan' => $request->jumlah_dikembalikan,
                'tgl_dikembalikan' => $request->tgl_dikembalikan,
                'status' => $status,
            ]);
        });

        return redirect()->route('pengembalian-barang.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pengembalian = PengembalianBarang::findOrFail($id);
            $peminjaman = $pengembalian->peminjamanBarang;
            $barang = $peminjaman->barang;

            if ($pengembalian->status === 'dikembalikan') {
                $barang->stok = max(0, $barang->stok - $pengembalian->jumlah_dikembalikan);
                $barang->save();

                if ($peminjaman->status !== 'diterima') {
                    $peminjaman->status = 'diterima';
                    $peminjaman->save();
                }
            }

            $pengembalian->delete();
        });

        return redirect()->route('pengembalian-barang.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
