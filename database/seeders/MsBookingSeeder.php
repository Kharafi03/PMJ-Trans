<?php

namespace Database\Seeders;

use App\Models\MsBooking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MsBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MsBooking::create([
            'name' => 'Draf',
        ]);

        MsBooking::create([
            'name' => 'Diterima',
        ]);

        MsBooking::create([
            'name' => 'Ditolak',
        ]);

        MsBooking::create([
            'name' => 'Dibatalkan',
        ]);
    }
}
