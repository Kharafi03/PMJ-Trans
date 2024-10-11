<?php

namespace Database\Seeders;

use App\Models\BusImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BusImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourcePath = public_path('img/');
        $destinationPath = 'public/bus_images/';

        $images = [
            [
                'id_bus' => '1',
                'image' => 'pmj02-1.jpg'
            ],
            [
                'id_bus' => '1',
                'image' => 'pmj02-2.jpg'
            ],
            [
                'id_bus' => '1',
                'image' => 'pmj02-3.jpg'
            ],
            [
                'id_bus' => '1',
                'image' => 'pmj02-4.jpg'
            ],
            [
                'id_bus' => '1',
                'image' => 'pmj02-5.jpg'
            ],

            [
                'id_bus' => '2',
                'image' => 'pmj03-1.jpg'
            ],
            [
                'id_bus' => '2',
                'image' => 'pmj03-2.jpg'
            ],
            [
                'id_bus' => '2',
                'image' => 'pmj03-3.jpg'
            ],
            [
                'id_bus' => '2',
                'image' => 'pmj03-4.jpg'
            ],
            [
                'id_bus' => '2',
                'image' => 'pmj03-5.jpg'
            ],
        ];

        foreach ($images as $image) {
            // Copy the image to the storage path
            $sourceFile = $sourcePath . $image['image'];
            $destinationFile = $destinationPath . $image['image'];

            if (!Storage::exists($destinationFile)) {
                Storage::put($destinationFile, file_get_contents($sourceFile));
            }

            // Update the photo path to storage path
            $image['image'] = 'bus_images/' . $image['image'];

            // Create the team record
            BusImage::create($image);
        }
    }
}