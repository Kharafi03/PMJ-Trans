<?php

namespace App\Filament\Resources\TripBusResource\Pages;

use App\Filament\Resources\TripBusResource;
use App\Models\TripBus;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListTripBuses extends ListRecords
{
    protected static string $resource = TripBusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Trip'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(label: 'Semua')
                ->badge(fn() => TripBus::count()),
            'now' => Tab::make(label: 'Saat Ini')
                ->badge(fn() => TripBus::whereHas('booking', function ($query) {
                    $query->where('date_start', '<=', now()->endOfDay())
                        ->where('date_end', '>=', now()->startOfDay());
                })->count())
                ->modifyQueryUsing(
                    fn($query) =>
                    $query
                        ->where('id_ms_trip', 2)
                        ->whereHas('booking', function ($query) {
                            $query->where('date_start', '<=', now()->endOfDay())
                                ->where('date_end', '>=', now()->startOfDay());
                        })
                ),
            'upcoming' => Tab::make(label: 'Mendatang')
                ->badge(fn() => TripBus::whereHas('booking', function ($query) {
                    $query->where('date_start', '>=', now()->startOfDay());
                })->count())
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->whereHas('booking', function ($query) {
                        $query->where('date_start', '>=', now()->startOfDay());
                    })
                ),
            'past' => Tab::make(label: 'Selesai')
                ->badge(fn() => TripBus::whereHas('booking', function ($query) {
                    $query->where('date_end', '<', now()->startOfDay());
                })->count())
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->whereHas('booking', function ($query) {
                        $query->where('date_end', '<', now()->startOfDay());
                    })
                ),
        ];
    }
}
