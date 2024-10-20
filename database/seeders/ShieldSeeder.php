<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class ShieldSeeder extends Seeder
{
    public function run()
    {
        // Permissions yang di-generate oleh Filament Shield (sesuaikan dengan resource Anda)
        $permissions = [
            'booking.view', 'booking.create', 'booking.update', 'booking.delete',
            'tripbus.view', 'tripbus.create', 'tripbus.update', 'tripbus.delete',
            // Tambahkan permissions sesuai kebutuhan Anda
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Membuat roles dan assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // Membuat role user biasa dan assign permission tertentu
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions([
            'booking.view',
            'tripbus.view',
            // Permission yang relevan untuk user biasa
        ]);

        // Optionally, assign role ke user tertentu
        $admin = \App\Models\User::first(); // Ambil user pertama
        if ($admin) {
            $admin->assignRole('admin');
        }

        Artisan::call('shield:install');
    }
}

