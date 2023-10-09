<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DummyAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penggunaData = [
            // Seeder untuk Admin
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'), // Ganti dengan password yang aman
                'role' => 'admin',
                'isActive' => true,
                'email_verified_at' => now(),
                'organization' => 'UPI FPBS',
                'jobTitle' => 'Admin',
                'address' => 'Jl. Setiabudhi No 229, Isola, Sukasari, Bandung, Indonesia',
            ],

            // Seeder untuk User
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make('user'), // Ganti dengan password yang aman
                'role' => 'user',
                'isActive' => true,
                'email_verified_at' => now(),
            ]
        ];

        foreach ($penggunaData as $key => $val){
            User::create($val);
        }
    }
}
