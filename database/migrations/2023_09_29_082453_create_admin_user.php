<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert Admin User
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'), // Ganti dengan password yang aman
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
            'organization' => 'UPI FPBS',
            'job_title' => 'Admin',
            'address' => 'Jl. Setiabudhi No 229, Isola, Sukasari, Bandung, Indonesia',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_user');
    }
};
