<?php

namespace Database\Seeders;

use App\Models\MsBus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MsBusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MsBus::create([
            'name' => 'Aktif',
        ]);

        MsBus::create([
            'name' => 'Non Aktif',
        ]);

        MsBus::create([
            'name' => 'Tersewa',
        ]);
    }
}
