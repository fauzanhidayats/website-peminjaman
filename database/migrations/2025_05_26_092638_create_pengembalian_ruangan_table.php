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
        Schema::create('pengembalian_ruangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_ruangan_id')->constrained('peminjaman_ruangan');
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
        Schema::dropIfExists('pengembalian_ruangan');
    }
};
