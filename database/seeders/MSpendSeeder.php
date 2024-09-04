<?php

namespace Database\Seeders;

use App\Models\MSpend;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MSpendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MSpend::create([
            'name' => 'BBM',
        ]);

        MSpend::create([
            'name' => 'Tol',
        ]);

        MSpend::create([
            'name' => 'Parkir',
        ]);

        MSpend::create([
            'name' => 'Makan',
        ]);

        MSpend::create([
            'name' => 'Service Darurat',
        ]);
    }
}
