<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman registrasi
     */
    public function showRegisterForm()
    {
        return view('auth.register'); // Ganti dengan path view registrasi kamu
    }

    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Ganti dengan path view login kamu
    }

    /**
     * Menangani proses registrasi
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6', // pastikan form punya field password_confirmation
        ]);

        // Buat user baru
        User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 2, // default role: peminjam
        ]);

        // Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }


    /**
     * Menangani proses login
     */
    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek apakah kredensial yang diberikan sesuai
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Jika berhasil login, regenerasi session untuk keamanan
        $request->session()->regenerate();

        // Ambil pengguna yang login
        $user = Auth::user();

        // Redirect berdasarkan role pengguna
        return match ($user->role->nama_role) { // Role ada di model User via relasi dengan Role
            'admin' => redirect()->route('dashboard.admin'),
            'peminjam' => redirect()->route('dashboard.peminjam'),
            'pimpinan' => redirect()->route('dashboard.pimpinan'),
            default => redirect('/'),
        };
    }

    /**
     * Menangani logout
     */
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Invalidate sesi dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
