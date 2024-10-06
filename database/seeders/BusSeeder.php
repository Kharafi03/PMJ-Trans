<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bus::create([
            'name' => 'PMJ-02',
            'license_plate' => 'K 1670 FW',
            'production_year' => '2014',
            'color' => 'Putih Abu-Abu',
            'machine_number' => 'YH244JSWJ238NS',
            'chassis_number' => '9BDR2BWK27BDWB',
            'capacity' => '50',
            'baggage' => '6',
            'ms_buses_id' => '1',
        ]);

        Bus::create([
            'name' => 'PMJ-03',
            'license_plate' => 'K 7464 OB',
            'production_year' => '2008',
            'color' => 'Hitam Merah',
            'machine_number' => '4JSWJ238NSYH24',
            'chassis_number' => 'BWK27BDWB9BDR2',
            'capacity' => '50',
            'baggage' => '6',
            'ms_buses_id' => '1',
        ]);

    }
}
