<?php

namespace Database\Seeders;

use App\Models\MsTrip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class MsTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MsTrip::create([
            'name' => 'Belum Perjalanan',
        ]);
        MsTrip::create([
            'name' => 'Dalam Perjalanan',
        ]);

        MsTrip::create([
            'name' => 'Selesai',
        ]);
    }
}
