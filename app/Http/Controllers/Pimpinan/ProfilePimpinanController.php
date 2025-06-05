<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilePimpinanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pimpinan.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'username' => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $validated['photo'] = $request->file('photo')->store('foto-users', 'public');
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
