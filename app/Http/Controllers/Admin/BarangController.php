<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::latest()->get();
        return view('admin.kelola-barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola-barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kondisi' => 'nullable|max:50',
            'lokasi' => 'nullable|max:100',
            'stok' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nama_barang', 'kondisi', 'lokasi', 'stok']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('foto-barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('kelola-barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.kelola-barang.detail', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.kelola-barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kondisi' => 'nullable|max:50',
            'lokasi' => 'nullable|max:100',
            'stok' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nama_barang', 'kondisi', 'lokasi', 'stok']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($barang->photo && Storage::disk('public')->exists($barang->photo)) {
                Storage::disk('public')->delete($barang->photo);
            }

            $data['photo'] = $request->file('photo')->store('foto-barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('kelola-barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus photo jika ada
        if ($barang->photo && Storage::disk('public')->exists($barang->photo)) {
            Storage::disk('public')->delete($barang->photo);
        }

        $barang->delete();

        return redirect()->route('kelola-barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
