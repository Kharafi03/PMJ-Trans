<?php

namespace Database\Seeders;

use App\Models\MIncome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MIncome::create([
            'name' => 'DP',
        ]);

        MIncome::create([
            'name' => 'Pelunasan',
        ]);

    }
}
