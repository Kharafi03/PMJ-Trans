<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Super Admin', // Nama pengguna
            'email' => 'superadmin@admin.com', // Email pengguna
            'number_phone' => '081234567890',
            'password' => Hash::make('12345678'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Admin', // Nama pengguna
            'email' => 'admin@admin.com', // Email pengguna
            'number_phone' => '081234567890',
            'password' => Hash::make('12345678'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Driver 1', // Nama pengguna
            'email' => 'driver1@admin.com', // Email pengguna
            'number_phone' => '089637222301',
            'password' => Hash::make('12345678'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Driver 2', // Nama pengguna
            'email' => 'driver2@admin.com', // Email pengguna
            'number_phone' => '089637222302',
            'password' => Hash::make('12345678'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Nida Aulia Karima', // Nama pengguna
            'email' => 'nida@gmail.com', // Email pengguna
            'number_phone' => '089619636519',
            'password' => Hash::make('12345678'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);       
    }
}
