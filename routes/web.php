<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\Auth\AuthController;

// Admin
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Admin\KendaraanController;

use App\Http\Controllers\Admin\DataPeminjamanBarangController;
use App\Http\Controllers\Admin\DataPeminjamanKendaraanController;
use App\Http\Controllers\Admin\DataPeminjamanRuanganController;

use App\Http\Controllers\Admin\DataPengembalianBarangController;
use App\Http\Controllers\Admin\DataPengembalianKendaraanController;
use App\Http\Controllers\Admin\DataPengembalianRuanganController;

use App\Http\Controllers\Admin\LaporanBarangController;
use App\Http\Controllers\Admin\LaporanKendaraanController;
use App\Http\Controllers\Admin\LaporanRuanganController;

// Peminjam
use App\Http\Controllers\Peminjam\DashboardPeminjamController;
use App\Http\Controllers\Peminjam\ProfilePeminjamController;

use App\Http\Controllers\Peminjam\LihatBarangController;
use App\Http\Controllers\Peminjam\LihatRuanganController;
use App\Http\Controllers\Peminjam\LihatKendaraanController;

use App\Http\Controllers\Peminjam\AjukanPinjamanBarangController;
use App\Http\Controllers\Peminjam\AjukanPinjamanRuanganController;
use App\Http\Controllers\Peminjam\AjukanPinjamanKendaraanController;

// Pimpinan
use App\Http\Controllers\Pimpinan\DashboardPimpinanController;
use App\Http\Controllers\Pimpinan\ProfilePimpinanController;

use App\Http\Controllers\Pimpinan\LaporanPimpinanBarangController;
use App\Http\Controllers\Pimpinan\LaporanPimpinanKendaraanController;
use App\Http\Controllers\Pimpinan\LaporanPimpinanRuanganController;


// Routes untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Routes untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard admin
    Route::prefix('dashboard/admin')->middleware('role:admin')->group(function () {
        Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard.admin');

        Route::resource('kelola-barang', BarangController::class);
        Route::resource('kelola-ruangan', RuanganController::class);
        Route::resource('kelola-kendaraan', KendaraanController::class);
        Route::resource('users', UserController::class);

        // Peminjaman barang
        Route::get('peminjaman-barang', [DataPeminjamanBarangController::class, 'index'])->name('admin.peminjaman-barang.index');
        Route::get('peminjaman-barang/{id}/edit', [DataPeminjamanBarangController::class, 'edit'])->name('admin.peminjaman-barang.edit');
        Route::put('peminjaman-barang/{id}', [DataPeminjamanBarangController::class, 'update'])->name('admin.peminjaman-barang.update');
        Route::get('peminjaman-barang/{id}/surat', [DataPeminjamanBarangController::class, 'downloadSurat'])->name('admin.peminjaman-barang.surat');

        // Peminjaman ruangan
        Route::get('peminjaman-ruangan', [DataPeminjamanRuanganController::class, 'index'])->name('admin.peminjaman-ruangan.index');
        Route::get('peminjaman-ruangan/{id}/edit', [DataPeminjamanRuanganController::class, 'edit'])->name('admin.peminjaman-ruangan.edit');
        Route::put('peminjaman-ruangan/{id}', [DataPeminjamanRuanganController::class, 'update'])->name('admin.peminjaman-ruangan.update');
        Route::get('peminjaman-ruangan/{id}/surat', [DataPeminjamanRuanganController::class, 'downloadSurat'])->name('admin.peminjaman-ruangan.surat');

        // Peminjaman Kendaraan
        Route::get('peminjaman-kendaraan', [DataPeminjamanKendaraanController::class, 'index'])->name('admin.peminjaman-kendaraan.index');
        Route::get('peminjaman-kendaraan/{id}/edit', [DataPeminjamanKendaraanController::class, 'edit'])->name('admin.peminjaman-kendaraan.edit');
        Route::put('peminjaman-kendaraan/{id}', [DataPeminjamanKendaraanController::class, 'update'])->name('admin.peminjaman-kendaraan.update');
        Route::get('peminjaman-kendaraan/{id}/surat', [DataPeminjamanKendaraanController::class, 'downloadSurat'])->name('admin.peminjaman-kendaraan.surat');


        Route::resource('pengembalian-barang', DataPengembalianBarangController::class);
        Route::resource('pengembalian-ruangan', DataPengembalianRuanganController::class);
        Route::resource('pengembalian-kendaraan', DataPengembalianKendaraanController::class);

        // Laporan Barang
        Route::get('laporan-barang', [LaporanBarangController::class, 'index'])->name('admin.laporan.barang.index');
        Route::post('laporan/peminjaman-barang', [LaporanBarangController::class, 'laporanPeminjamanBarang'])->name('admin.laporan.peminjaman.barang');
        Route::post('laporan/pengembalian-barang', [LaporanBarangController::class, 'laporanPengembalianBarang'])->name('admin.laporan.pengembalian.barang');
        // Cetak PDF laporan
        Route::get('laporan/peminjaman-barang/pdf', [LaporanBarangController::class, 'cetakPeminjamanBarangPDF'])->name('admin.laporan.peminjaman.barang.pdf');
        Route::get('laporan/pengembalian-barang/pdf', [LaporanBarangController::class, 'cetakPengembalianBarangPDF'])->name('admin.laporan.pengembalian.barang.pdf');


        // Laporan ruangan
        Route::get('laporan-ruangan', [LaporanRuanganController::class, 'index'])->name('admin.laporan.ruangan.index');
        Route::post('laporan/peminjaman-ruangan', [LaporanRuanganController::class, 'laporanPeminjamanRuangan'])->name('admin.laporan.peminjaman.ruangan');
        Route::post('laporan/pengembalian-ruangan', [LaporanRuanganController::class, 'laporanPengembalianRuangan'])->name('admin.laporan.pengembalian.ruangan');
        // Cetak PDF laporan
        Route::get('laporan/peminjaman-ruangan/pdf', [LaporanRuanganController::class, 'cetakPeminjamanRuanganPDF'])->name('admin.laporan.peminjaman.ruangan.pdf');
        Route::get('laporan/pengembalian-ruangan/pdf', [LaporanRuanganController::class, 'cetakPengembalianRuanganPDF'])->name('admin.laporan.pengembalian.ruangan.pdf');


        // Laporan kendaraan
        Route::get('laporan-kendaraan', [LaporanKendaraanController::class, 'index'])->name('admin.laporan.kendaraan.index');
        Route::post('laporan/peminjaman-kendaraan', [LaporanKendaraanController::class, 'laporanPeminjamanKendaraan'])->name('admin.laporan.peminjaman.kendaraan');
        Route::post('laporan/pengembalian-kendaraan', [LaporanKendaraanController::class, 'laporanPengembalianKendaraan'])->name('admin.laporan.pengembalian.kendaraan');
        // Cetak PDF laporan
        Route::get('laporan/peminjaman-kendaraan/pdf', [LaporanKendaraanController::class, 'cetakPeminjamanKendaraanPDF'])->name('admin.laporan.peminjaman.kendaraan.pdf');
        Route::get('laporan/pengembalian-kendaraan/pdf', [LaporanKendaraanController::class, 'cetakPengembalianKendaraanPDF'])->name('admin.laporan.pengembalian.kendaraan.pdf');

        // Profile admin
        Route::get('profile', [ProfileAdminController::class, 'index'])->name('admin.profile');
        Route::put('profile', [ProfileAdminController::class, 'update'])->name('admin.profile.update');
    });

    // Dashboard peminjam
    Route::prefix('dashboard/peminjam')->middleware('role:peminjam')->group(function () {
        Route::get('/', [DashboardPeminjamController::class, 'index'])->name('dashboard.peminjam');

        Route::get('lihat-barang', [LihatBarangController::class, 'index'])->name('lihat-barang');
        Route::get('lihat-ruangan', [LihatRuanganController::class, 'index'])->name('lihat-ruangan');
        Route::get('lihat-kendaraan', [LihatKendaraanController::class, 'index'])->name('lihat-kendaraan');

        // Peminjaman barang oleh peminjam
        Route::get('peminjaman-barang', [AjukanPinjamanBarangController::class, 'index'])->name('peminjaman-barang.index');
        Route::get('peminjaman-barang/create/{barang_id}', [AjukanPinjamanBarangController::class, 'create'])->name('peminjaman-barang.create');
        Route::post('peminjaman-barang/store', [AjukanPinjamanBarangController::class, 'store'])->name('peminjaman-barang.store');

        // Peminjaman Ruangan oleh peminjam
        Route::get('peminjaman-ruangan', [AjukanPinjamanRuanganController::class, 'index'])->name('peminjaman-ruangan.index');
        Route::get('peminjaman-ruangan/create/{ruangan_id}', [AjukanPinjamanRuanganController::class, 'create'])->name('peminjaman-ruangan.create');
        Route::post('peminjaman-ruangan/store', [AjukanPinjamanRuanganController::class, 'store'])->name('peminjaman-ruangan.store');

        // Peminjaman kendaraan oleh peminjam
        Route::get('peminjaman-kendaraan', [AjukanPinjamanKendaraanController::class, 'index'])->name('peminjaman-kendaraan.index');
        Route::get('peminjaman-kendaraan/create/{kendaraan_id}', [AjukanPinjamanKendaraanController::class, 'create'])->name('peminjaman-kendaraan.create');
        Route::post('peminjaman-kendaraan/store', [AjukanPinjamanKendaraanController::class, 'store'])->name('peminjaman-kendaraan.store');


        // Profile peminjam
        Route::get('profile', [ProfilePeminjamController::class, 'index'])->name('peminjam.profile');
        Route::put('profile', [ProfilePeminjamController::class, 'update'])->name('peminjam.profile.update');
    });

    // Dashboard pimpinan
    Route::prefix('dashboard/pimpinan')->middleware('role:pimpinan')->group(function () {
        Route::get('/', [DashboardPimpinanController::class, 'index'])->name('dashboard.pimpinan');

        // Laporan Barang
        Route::get('laporan-barang', [LaporanPimpinanBarangController::class, 'index'])->name('pimpinan.laporan.barang.index');
        Route::post('laporan/peminjaman-barang', [LaporanPimpinanBarangController::class, 'laporanPeminjamanBarang'])->name('pimpinan.laporan.peminjaman.barang');
        Route::post('laporan/pengembalian-barang', [LaporanPimpinanBarangController::class, 'laporanPengembalianBarang'])->name('pimpinan.laporan.pengembalian.barang');
        // Cetak PDF laporan
        Route::get('laporan/peminjaman-barang/pdf', [LaporanPimpinanBarangController::class, 'cetakPeminjamanBarangPDF'])->name('pimpinan.laporan.peminjaman.barang.pdf');
        Route::get('laporan/pengembalian-barang/pdf', [LaporanPimpinanBarangController::class, 'cetakPengembalianBarangPDF'])->name('pimpinan.laporan.pengembalian.barang.pdf');


        // Laporan ruangan
        Route::get('laporan-ruangan', [LaporanPimpinanRuanganController::class, 'index'])->name('pimpinan.laporan.ruangan.index');
        Route::post('laporan/peminjaman-ruangan', [LaporanPimpinanRuanganController::class, 'laporanPeminjamanRuangan'])->name('pimpinan.laporan.peminjaman.ruangan');
        Route::post('laporan/pengembalian-ruangan', [LaporanPimpinanRuanganController::class, 'laporanPengembalianRuangan'])->name('pimpinan.laporan.pengembalian.ruangan');
        // Cetak PDF laporan
        Route::get('laporan/peminjaman-ruangan/pdf', [LaporanPimpinanRuanganController::class, 'cetakPeminjamanRuanganPDF'])->name('pimpinan.laporan.peminjaman.ruangan.pdf');
        Route::get('laporan/pengembalian-ruangan/pdf', [LaporanPimpinanRuanganController::class, 'cetakPengembalianRuanganPDF'])->name('pimpinan.laporan.pengembalian.ruangan.pdf');


        // Laporan kendaraan
        Route::get('laporan-kendaraan', [LaporanPimpinanKendaraanController::class, 'index'])->name('pimpinan.laporan.kendaraan.index');
        Route::post('laporan/peminjaman-kendaraan', [LaporanPimpinanKendaraanController::class, 'laporanPeminjamanKendaraan'])->name('pimpinan.laporan.peminjaman.kendaraan');
        Route::post('laporan/pengembalian-kendaraan', [LaporanPimpinanKendaraanController::class, 'laporanPengembalianKendaraan'])->name('pimpinan.laporan.pengembalian.kendaraan');
        // Cetak PDF laporan
        Route::get('laporan/peminjaman-kendaraan/pdf', [LaporanPimpinanKendaraanController::class, 'cetakPeminjamanKendaraanPDF'])->name('pimpinan.laporan.peminjaman.kendaraan.pdf');
        Route::get('laporan/pengembalian-kendaraan/pdf', [LaporanPimpinanKendaraanController::class, 'cetakPengembalianKendaraanPDF'])->name('pimpinan.laporan.pengembalian.kendaraan.pdf');

        // Profile pimpinan
        Route::get('profile', [ProfilePimpinanController::class, 'index'])->name('pimpinan.profile');
        Route::put('profile', [ProfilePimpinanController::class, 'update'])->name('pimpinan.profile.update');
    });
});
