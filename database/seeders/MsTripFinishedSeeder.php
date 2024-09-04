<?php

namespace Database\Seeders;

use App\Models\MsTripFinished;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MsTripFinishedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MsTripFinished::create([
            'name' => 'Lunas',
        ]);

        MsTripFinished::create([
            'name' => 'Belum Lunas',
        ]);
    }
}
