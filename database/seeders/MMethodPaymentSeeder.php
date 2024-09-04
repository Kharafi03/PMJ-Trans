<?php

namespace Database\Seeders;

use App\Models\MMethodPayment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MMethodPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MMethodPayment::create([
            'name' => 'Tunai',
        ]);

        MMethodPayment::create([
            'name' => 'Transfer Bank',
        ]);

        MMethodPayment::create([
            'name' => 'Transfer E-Wallet',
        ]);
    }
}
