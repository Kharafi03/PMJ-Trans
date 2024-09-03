<?php

namespace Database\Seeders;

use App\Models\MMaintenance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MMaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MMaintenance::create([
            'name' => 'Perbaikan Mesin',
        ]);

        MMaintenance::create([
            'name' => 'Perbaikan Rem',
        ]);

        MMaintenance::create([
            'name' => 'Perbaikan Oli',
        ]);

        MMaintenance::create([
            'name' => 'Perbaikan Aki',
        ]);

        MMaintenance::create([
            'name' => 'Perbaikan Ban',
        ]);

        MMaintenance::create([
            'name' => 'Perbaikan AC',
        ]);

        MMaintenance::create([
            'name' => 'Perbaikan Lainnya',
        ]);
    }
}
