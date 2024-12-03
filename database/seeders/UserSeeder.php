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
            'password' => Hash::make('kudusbus@22'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Admin', // Nama pengguna
            'email' => 'admin@admin.com', // Email pengguna
            'number_phone' => '081234567890',
            'password' => Hash::make('transkudus@24'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Driver 1', // Nama pengguna
            'email' => 'driver1@admin.com', // Email pengguna
            'number_phone' => '089637222301',
            'password' => Hash::make('driverkudus@22'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Driver 2', // Nama pengguna
            'email' => 'driver2@admin.com', // Email pengguna
            'number_phone' => '089637222302',
            'password' => Hash::make('driverkudus@24'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Driver 3', // Nama pengguna
            'email' => 'driver3@admin.com', // Email pengguna
            'number_phone' => '089637222303',
            'password' => Hash::make('driverkudus@26'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Driver 4', // Nama pengguna
            'email' => 'driver4@admin.com', // Email pengguna
            'number_phone' => '089637222311',
            'password' => Hash::make('driverkudus@28'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Kru 1', // Nama pengguna
            'email' => 'Kru1@admin.com', // Email pengguna
            'number_phone' => '089637222312',
            'password' => Hash::make('crewkudus@32'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Kru 2', // Nama pengguna
            'email' => 'Kru2@admin.com', // Email pengguna
            'number_phone' => '089637222314',
            'password' => Hash::make('crewkudus@34'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Kru 3', // Nama pengguna
            'email' => 'Kru3@admin.com', // Email pengguna
            'number_phone' => '089637222315',
            'password' => Hash::make('crewkudus@36'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);

        User::create([
            'name' => 'Kru 4', // Nama pengguna
            'email' => 'Kru4@admin.com', // Email pengguna
            'number_phone' => '089637222316',
            'password' => Hash::make('crewkudus@38'), // Password pengguna yang dienkripsi
            'nik' => '1234567890123456',
            'sim' => '1234567890123456',
            'id_ms' => 1,
        ]);
    }
}
