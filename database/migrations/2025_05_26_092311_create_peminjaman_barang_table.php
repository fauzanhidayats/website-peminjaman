<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('barang_id')->constrained('barang');
            $table->integer('jumlah');
            $table->string('kegiatan')->nullable();
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->enum('status', ['diajukan', 'diterima', 'ditolak'])->default('diajukan');
            $table->string('surat_peminjaman')->nullable();
            $table->date('tgl_cetak_surat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_barang');
    }
};
