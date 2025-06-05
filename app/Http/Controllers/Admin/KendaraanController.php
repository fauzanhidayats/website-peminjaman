<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::latest()->get();
        return view('admin.kelola-kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kelola-kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kendaraan' => 'required|max:100',
            'jenis' => 'nullable|max:50',
            'nomor_polisi' => 'required|max:50|unique:kendaraan,nomor_polisi',
            'kondisi' => 'nullable|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_kendaraan', 'jenis', 'nomor_polisi', 'kondisi']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('foto-kendaraan', 'public');
        }

        Kendaraan::create($data);

        return redirect()->route('kelola-kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kelola-kendaraan.detail', compact('kendaraan'));
    }

    public function edit(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kelola-kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'nama_kendaraan' => 'required|max:100',
            'jenis' => 'nullable|max:50',
            'nomor_polisi' => 'required|max:50|unique:kendaraan,nomor_polisi,' . $kendaraan->id,
            'kondisi' => 'nullable|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_kendaraan', 'jenis', 'nomor_polisi', 'kondisi']);

        if ($request->hasFile('photo')) {
            if ($kendaraan->photo && Storage::disk('public')->exists($kendaraan->photo)) {
                Storage::disk('public')->delete($kendaraan->photo);
            }
            $data['photo'] = $request->file('photo')->store('foto-kendaraan', 'public');
        }

        $kendaraan->update($data);

        return redirect()->route('kelola-kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        if ($kendaraan->photo && Storage::disk('public')->exists($kendaraan->photo)) {
            Storage::disk('public')->delete($kendaraan->photo);
        }

        $kendaraan->delete();

        return redirect()->route('kelola-kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
