<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermisionsSeeder::class);
        $this->call(MsUserSeeder::class);
        $this->call(UserSeeder::class); 
        $this->call(MsBusSeeder::class);
        $this->call(MMaintenanceSeeder::class);
        // $this->call(PermisionsSeeder::class);
    }
}
