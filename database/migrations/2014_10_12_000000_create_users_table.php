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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role',['admin', 'user'])->default('user'); // Role
            $table->boolean('is_active')->default(true); // Status Aktif
            $table->string('photo')->nullable(); // Tambahkan kolom foto profil
            $table->string('phone_number')->nullable(); // Nomor Telepon
            $table->string('address')->nullable(); // Alamat
            $table->string('organization')->nullable(); // Unit/Organisasi
            $table->string('job_title')->nullable(); // Jabatan
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
