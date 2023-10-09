<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Booking Room (Pivot Table):
     * Arti: "Booking room" merujuk kepada tabel perantara (pivot table) 
     * yang menghubungkan antara peminjaman (booking) dan ruangan (room). 
     * Tabel ini diperlukan dalam hubungan many-to-many antara peminjaman dan ruangan, 
     * karena satu peminjaman bisa melibatkan banyak ruangan dan sebaliknya.
     * 
     * Contoh Penggunaan: "Data peminjaman ruangan disimpan dalam tabel booking room 
     * yang mencatat id peminjaman dan id ruangan yang terlibat."
     * 
     * 
     */
    public function up(): void
    {
        Schema::create('transaction_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('room_id');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_rooms');
    }
};
