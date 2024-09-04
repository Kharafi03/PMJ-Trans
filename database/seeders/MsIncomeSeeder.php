<?php

namespace Database\Seeders;

use App\Models\MsIncome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MsIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MsIncome::create([
            'name' => 'Draf',
        ]);
        
        MsIncome::create([
            'name' => 'Diterima',
        ]);

        MsIncome::create([
            'name' => 'Ditolak',
        ]);
    }
}
