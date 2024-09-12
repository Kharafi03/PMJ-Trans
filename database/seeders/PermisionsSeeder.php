<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::create([
            'role' => 'Super Admin'
        ]);

        Permission::create([
            'role' => 'Admin'
        ]);

        Permission::create([
            'role' => 'Driver'    
        ]);

        Permission::create([
            'role' => 'Customer'
        ]);

    }
}
