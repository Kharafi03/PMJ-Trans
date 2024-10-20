<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourcePath = public_path('img/');
        $destinationPath = 'public/setting/';

        $logos = [
            [
            'name' => 'PMJ-Trans',
            'logo' => 'logo.png',
            'address' => 'Jl. Lingkar Timur, Ngembal Rejo, Kecamatan Jati, Kabupaten Kudus, Jawa Tengah',
            'email' => 'buspmjtrans@gmail.com',
            'contact' => '0812-2562-5255',
            'open_hours' => 'Setiap hari jam 07.00 - 17.00 WIB',
            'description' => '',
            'maps' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12978.348270618128!2d110.8778704!3d-6.8190866!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70c5cdd4042793%3A0x22dfa84ed6ce52de!2sGarasi%20Bus%20PMJ%20Trans!5e1!3m2!1sid!2sid!4v1724347397670!5m2!1sid!2sid',
            'sosmed_ig' => 'https://www.instagram.com/mahkotagroup.official/',
            'sosmed_fb' => 'https://www.facebook.com/share/t1VWTThuBDxpPnBn/',
            'sosmed_yt' => 'https://www.youtube.com/@buspmjtrans',
            'footer' => 'PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan',
            'about_us' => 'PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan.',

            ],
        ];

        foreach ($logos as $logo) {
            // Copy the image to the storage path
            $sourceFile = $sourcePath . $logo['logo'];
            $destinationFile = $destinationPath . $logo['logo'];

            if (!Storage::exists($destinationFile)) {
                Storage::put($destinationFile, file_get_contents($sourceFile));
            }

            // Update the photo path to storage path
            $logo['logo'] = 'setting/' . $logo['logo'];

            // Create the team record
            Setting::create($logo);
        }
    }
}
