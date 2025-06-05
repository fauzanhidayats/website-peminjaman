<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::latest()->get();
        return view('admin.kelola-ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('admin.kelola-ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kondisi' => 'nullable|max:50',
            'kapasitas' => 'nullable|integer',
            'lokasi' => 'nullable|max:100',
        ]);

        $data = $request->only(['nama_ruangan', 'kondisi', 'kapasitas', 'lokasi']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('foto-ruangan', 'public');
        }

        Ruangan::create($data);

        return redirect()->route('kelola-ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.kelola-ruangan.detail', compact('ruangan'));
    }

    public function edit(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.kelola-ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, string $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'nama_ruangan' => 'required|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kondisi' => 'nullable|max:50',
            'kapasitas' => 'nullable|integer',
            'lokasi' => 'nullable|max:100',
        ]);

        $data = $request->only(['nama_ruangan', 'kondisi', 'kapasitas', 'lokasi']);

        if ($request->hasFile('photo')) {
            if ($ruangan->photo && Storage::disk('public')->exists($ruangan->photo)) {
                Storage::disk('public')->delete($ruangan->photo);
            }
            $data['photo'] = $request->file('photo')->store('foto-ruangan', 'public');
        }

        $ruangan->update($data);

        return redirect()->route('kelola-ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        if ($ruangan->photo && Storage::disk('public')->exists($ruangan->photo)) {
            Storage::disk('public')->delete($tempat->photo);
        }

        $ruangan->delete();

        return redirect()->route('kelola-ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
