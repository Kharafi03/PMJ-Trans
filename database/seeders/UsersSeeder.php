<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sourcePath = public_path('images/driver/');
        $destinationPath = 'public/driver/';

        $users = [
            [
                'nama' => 'Admin 1',
                'email' => 'admin@gmail.com',
                'nomor_telepon' => '081234567890',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 'aktif',
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Driver 1',
                'email' => 'driver1@gmail.com',
                'nomor_telepon' => '081234567891',
                'password' => Hash::make('12345678'),
                'role' => 'driver',
                'ktp' => 'KTP.jpg',
                'sim' => 'SIM.jpg',
                'status' => 'aktif',
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            // Iterate over each image
            if (isset($user['ktp']) && isset($user['sim'])) {
                for ($i = 1; $i <= 2; $i++) {
                    $imageKey = 'ktp';

                    if ($i == 2) {
                        $imageKey = 'sim';
                    }

                    // Get source and destination paths for the current image
                    $sourceFile = $sourcePath . $user[$imageKey];
                    $destinationFile = $destinationPath . basename($user[$imageKey]); // Ambil bagian akhir jalur gambar

                    // Check if the destination file doesn't exist
                    if (!Storage::exists($destinationFile)) {
                        // Copy the image to the destination path
                        Storage::put($destinationFile, file_get_contents($sourceFile));
                    }

                    // Update the photo path to the storage path for the current image
                    $user[$imageKey] = 'driver/' . basename($user[$imageKey]);
                }
            }

            // Create the user record
            DB::table('users')->insert($user);
        }
    }
}
