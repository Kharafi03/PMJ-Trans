<?php

namespace App\Filament\Resources\TripFinishedResource\Pages;

use App\Filament\Resources\TripFinishedResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTripFinished extends CreateRecord
{
    protected static string $resource = TripFinishedResource::class;
    public function getTitle(): string
    {
        return 'Tambah Trip';
    }
}
