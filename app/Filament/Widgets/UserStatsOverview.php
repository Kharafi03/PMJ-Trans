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

        return [
            Stat::make('Total Driver', $totalDriver)
                ->description('Total Driver')
                ->color('info')
                ->icon('heroicon-m-user')
                ->extraAttributes([
                    'class' => 'card-stat  text-blue-800 p-6 rounded shadow-lg',
                    'style' => 'font-size: 1.5em; display: flex; align-items: center;'
                ]),

            Stat::make('Total Customer', $totalCustomer)
                ->description('Total Customer')
                ->color('warning')
                ->icon('heroicon-s-user-group')
                ->extraAttributes([
                    'class' => 'card-stat  text-yellow-800 p-6 rounded shadow-lg',
                    'style' => 'font-size: 1.5em; display: flex; align-items: center;'
                ]),

            Stat::make('Total Admin', $totalAdmin)
                ->description('Total Admin')
                ->color('green')
                ->icon('heroicon-s-cog')
                ->extraAttributes([
                    'class' => 'card-stat  text-yellow-800 p-6 rounded shadow-lg',
                    'style' => 'font-size: 1.5em; display: flex; align-items: center;'
                ]),

            Stat::make('Total Super Admin', $totalSuperAdmin)
                ->description('Total Super Admin')
                ->color('danger')
                ->icon('heroicon-s-star')
                ->extraAttributes([
                    'class' => 'card-stat  text-yellow-800 p-6 rounded shadow-lg',
                    'style' => 'font-size: 1.5em; display: flex; align-items: center;'
                ]),
        ];
    }
}
