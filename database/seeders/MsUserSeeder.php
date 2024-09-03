<?php

namespace Database\Seeders;

use App\Models\MsBus;
use App\Models\MsUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        MsUser::create([
            'name' => 'Aktif',
        ]);

        MsUser::create([
            'name' => 'Tidak Aktif',
        ]);

        MsUser::create([
            'name' => 'Ontask',
        ]);

        MsUser::create([
            'name' => 'Block',
        ]);

    }
}
