<?php

namespace App\Filament\Resources\TripBusResource\Pages;

use App\Filament\Resources\TripBusResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTripBus extends CreateRecord
{
    protected static string $resource = TripBusResource::class;
    public function getTitle(): string
    {
        return 'Tambah Trip';
    }
}
