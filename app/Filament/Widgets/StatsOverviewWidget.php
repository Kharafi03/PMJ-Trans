<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking;
use App\Models\User;
use App\Models\Mail;
use Spatie\Permission\Models\Role;

class StatsOverviewWidget extends BaseWidget
{
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
                ->color('primary')
                ->icon('heroicon-c-shopping-bag')
                ->extraAttributes(['class' => 'bg-blue-100 hover:bg-blue-200 transition-transform transform hover:scale-105 p-4 rounded shadow-lg']),
            Stat::make('Total Driver', $totalDriver)
                ->description('Total Driver')
                ->color('success')
                ->icon('heroicon-m-user')
                ->extraAttributes(['class' => 'bg-green-100 hover:bg-green-200 transition-transform transform hover:scale-105 p-4 rounded shadow-lg']),

            Stat::make('Total Customer', $totalCustomer)
                ->description('Total Customer')
                ->color('warning')
                ->icon('heroicon-s-user-group')
                ->extraAttributes(['class' => 'bg-yellow-100 hover:bg-yellow-200 transition-transform transform hover:scale-105 p-4 rounded shadow-lg']),

            Stat::make('Total Pesan', $totalPesan)
                ->description('Total Pesan')
                ->color('info')
                ->icon('heroicon-s-envelope')
                ->extraAttributes(['class' => 'bg-teal-100 hover:bg-teal-200 transition-transform transform hover:scale-105 p-4 rounded shadow-lg']),

        ];
    }
}
