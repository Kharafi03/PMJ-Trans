<?php

namespace App\Filament\Resources\TripFinishedResource\Pages;

use App\Filament\Resources\TripFinishedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTripFinisheds extends ListRecords
{
    protected static string $resource = TripFinishedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Trip'),
        ];
    }
}
