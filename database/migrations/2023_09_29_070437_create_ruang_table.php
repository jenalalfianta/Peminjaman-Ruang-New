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
        Schema::create('ruang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruangan')->unique(); // Kode Ruang (unik)
            $table->string('nama_ruangan'); // Nama Ruang
            $table->string('lantai_ruangan'); // Lantai Ruang
            $table->integer('kapasitas'); // Kapasitas Ruang
            $table->text('deskripsi')->nullable(); // Deskripsi Ruang (opsional, bisa kosong)
            $table->boolean('aktif'); // Aktif atau Nonaktif (default: aktif)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang');
    }
};
