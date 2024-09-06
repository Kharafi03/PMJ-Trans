<?php

namespace Database\Seeders;

use App\Models\MOutcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MOutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MOutcome::create([
            'name' => 'Refund',
        ]);

        MOutcome::create([
            'name' => 'Operasional',
        ]);
    }
}
