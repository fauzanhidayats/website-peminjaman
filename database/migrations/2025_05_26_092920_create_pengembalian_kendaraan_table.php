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
        Schema::create('pengembalian_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_kendaraan_id')->constrained('peminjaman_kendaraan');
            $table->date('tgl_dikembalikan')->nullable();
            $table->enum('status', ['belum', 'dikembalikan'])->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_kendaraan');
    }
};
