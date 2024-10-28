<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking;
use App\Models\User;
use App\Models\Mail;
use Spatie\Permission\Models\Role;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class StatsOverviewWidget extends BaseWidget
{
    use HasWidgetShield;

    protected function getStats(): array
    {
        // Menghitung total booking
        $totalBooking = Booking::count();

        // Menghitung total driver berdasarkan role
        $roleDriver = Role::where('name', 'driver')->first();
        $totalDriver = $roleDriver ? User::role('driver')->count() : 0;

        // Menghitung total customer berdasarkan role panel_user
        $roleCustomer = Role::where('name', 'panel_user')->first();
        $totalCustomer = $roleCustomer ? User::role('panel_user')->count() : 0;

        // Menghitung total pesan
        $totalPesan = Mail::count();

        // Mengembalikan data untuk ditampilkan di widget
        return [
            Stat::make('Total Booking', $totalBooking)
                ->description('Total Booking')
                ->icon('heroicon-c-shopping-bag') 
                ->color('success') 
                ->extraAttributes([
                    'class' => 'card-stat bg-green-100 text-green-800 p-6 rounded shadow-lg',
                    'style' => 'font-size: 1.5em; display: flex; align-items: center;'
                ]), 
            
            Stat::make('Total Driver', $totalDriver)
                ->description('Total Driver')
                ->icon('heroicon-m-user')
                ->color('info') 
                ->extraAttributes([
                    'class' => 'card-stat bg-blue-100 text-blue-800 p-6 rounded shadow-lg',
                    'style' => 'font-size: 1.5em; display: flex; align-items: center;'
                ]),
            
            Stat::make('Total Customer', $totalCustomer)
                ->description('Total Customer')
                ->icon('heroicon-s-user-group')
                ->color('warning') 
                ->extraAttributes([
                    'class' => 'card-stat bg-blue-100 text-blue-800 p-6 rounded shadow-lg',
                    'style' => 'font-size: 1.5em; display: flex; align-items: center;'
                ]),
            
            Stat::make('Total Pesan', $totalPesan)
                ->description('Total Pesan')
                ->icon('heroicon-s-envelope')
                ->color('primary') 
                ->extraAttributes([
                    'class' => 'card-stat bg-teal-100 text-teal-800 p-6 rounded shadow-lg',
                    'style' => 'font-size: 1.5em; display: flex; align-items: center;'
                ]),
        ];
    }
}
