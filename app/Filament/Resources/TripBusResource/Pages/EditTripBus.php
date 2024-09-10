<?php

namespace App\Filament\Resources\TripBusResource\Pages;

use App\Filament\Resources\TripBusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTripBus extends EditRecord
{
    protected static string $resource = TripBusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
