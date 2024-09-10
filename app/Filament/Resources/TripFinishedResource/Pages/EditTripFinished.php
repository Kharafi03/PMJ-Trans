<?php

namespace App\Filament\Resources\TripFinishedResource\Pages;

use App\Filament\Resources\TripFinishedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTripFinished extends EditRecord
{
    protected static string $resource = TripFinishedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
