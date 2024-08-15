<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

use App\Models\Bus;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sourcePath = public_path('images/bus/');
        $destinationPath = 'public/bus/';

        $buses = [
            [
                'nama_bus' => 'Bus 1',
                'plat_nomor' => '1234',
                'tahun' => '2022',
                'warna' => 'Merah',
                'no_mesin' => '1234',
                'no_sasis' => '1234',
                'jumlah_penumpang' => '50',
                'bagasi' => '20',
                'gambar1' => 'mpv-toyota-innova-1-hitam.jpg',
                'gambar2' => 'mpv-toyota-innova-2-hitam.jpg',
                'gambar3' => 'mpv-toyota-innova-3-hitam.jpg',
                'gambar4' => 'mpv-toyota-innova-4-hitam.jpg',
                'status' => 'aktif',
                'is_deleted' => '0',
            ],
        ];

        foreach ($buses as $bus) {
            // Iterate over each image
            for ($i = 1; $i <= 4; $i++) {
                $imageKey = 'gambar' . $i;

                // Get source and destination paths for the current image
                $sourceFile = $sourcePath . $bus[$imageKey];
                $destinationFile = $destinationPath . basename($bus[$imageKey]); // Ambil bagian akhir jalur gambar

                // Check if the destination file doesn't exist
                if (!Storage::exists($destinationFile)) {
                    // Copy the image to the destination path
                    Storage::put($destinationFile, file_get_contents($sourceFile));
                }

                // Update the photo path to the storage path for the current image
                $bus[$imageKey] = 'bus/' . basename($bus[$imageKey]);
            }

            // Create the car record
            Bus::create($bus);

        }
    }

}
