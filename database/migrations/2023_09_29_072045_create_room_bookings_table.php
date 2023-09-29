<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Room Booking:
     * Arti: "Room booking" merujuk kepada tindakan atau proses membooking (mengajukan peminjaman) 
     * sebuah ruangan untuk penggunaan tertentu dalam rentang waktu tertentu.
     * 
     * Contoh Penggunaan: "Pengguna melakukan room booking untuk ruangan X dari tanggal A hingga 
     * tanggal B."
     * 
     */
    public function up(): void
    {
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->enum('status', ['pending', 'approved', 'rejected', 'canceled'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_bookings');
    }
};
