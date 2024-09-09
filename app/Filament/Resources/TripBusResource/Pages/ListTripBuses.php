<?php

namespace App\Filament\Resources\TripBusResource\Pages;

use App\Filament\Resources\TripBusResource;
use Filament\Actions;
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
}
