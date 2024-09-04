<?php

namespace Database\Seeders;

use App\Models\MsPaymentBooking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MsPaymentBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MsPaymentBooking::create([
            'name' => 'Draf',
        ]);

        MsPaymentBooking::create([
            'name' => 'DP Belum Dibayar',
        ]);

        MsPaymentBooking::create([
            'name' => 'DP Dibayarkan',
        ]);

        MsPaymentBooking::create([
            'name' => 'Lunas',
        ]);
    }
}
