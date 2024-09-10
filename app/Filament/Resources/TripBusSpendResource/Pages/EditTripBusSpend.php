<?php

namespace App\Filament\Resources\TripBusSpendResource\Pages;

use App\Filament\Resources\TripBusSpendResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTripBusSpend extends EditRecord
{
    protected static string $resource = TripBusSpendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
