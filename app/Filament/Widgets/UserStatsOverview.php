<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Spatie\Permission\Models\Role;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class UserStatsOverview extends BaseWidget
{
    use HasWidgetShield;
    protected function getStats(): array
    {
    
        // Menghitung total driver berdasarkan role
        $roleDriver = Role::where('name', 'driver')->first();
        $totalDriver = $roleDriver ? User::role('driver')->count() : 0;

        // Menghitung total customer berdasarkan role panel_user
        $roleCustomer = Role::where('name', 'panel_user')->first();
        $totalCustomer = $roleCustomer ? User::role('panel_user')->count() : 0;

        // Menghitung total admin berdasarkan role admin
        $roleAdmin = Role::where('name', 'admin')->first();
        $totalAdmin = $roleAdmin ? User::role('admin')->count() : 0;

        // Menghitung total super admin berdasarkan role super_admin
        $roleSuperAdmin = Role::where('name', 'super_admin')->first();
        $totalSuperAdmin = $roleSuperAdmin ? User::role('super_admin')->count() : 0;

        // Mengembalikan data untuk ditampilkan di widget dalam flex container
        return [
            Stat::make('Total Driver', $totalDriver)
                ->description('Total Driver')
                ->color('success')
                ->icon('heroicon-m-user')
                ->extraAttributes(['class' => 'bg-green-100 hover:bg-green-200 transition-transform duration-300 ease-in-out transform hover:scale-105 p-4 rounded shadow-lg flex-1']),

            Stat::make('Total Customer', $totalCustomer)
                ->description('Total Customer')
                ->color('warning')
                ->icon('heroicon-s-user-group')
                ->extraAttributes(['class' => 'hover:bg-yellow-200 transition-transform duration-300 ease-in-out transform hover:scale-105 p-4 rounded shadow-lg flex-1']),

            Stat::make('Total Admin', $totalAdmin)
                ->description('Total Admin')
                ->color('info')
                ->icon('heroicon-s-cog')
                ->extraAttributes(['class' => 'bg-blue-100 hover:bg-blue-200 transition-transform duration-300 ease-in-out transform hover:scale-105 p-4 rounded shadow-lg flex-1']),

            Stat::make('Total Super Admin', $totalSuperAdmin)
                ->description('Total Super Admin')
                ->color('danger')
                ->icon('heroicon-s-star')
                ->extraAttributes(['class' => 'hover:bg-red-200 transition-transform duration-300 ease-in-out transform hover:scale-105 p-4 rounded shadow-lg flex-1']),
        ];
    }
}
