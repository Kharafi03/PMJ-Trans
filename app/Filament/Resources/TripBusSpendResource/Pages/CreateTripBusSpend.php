<?php

namespace App\Filament\Resources\TripBusSpendResource\Pages;

use App\Filament\Resources\TripBusSpendResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTripBusSpend extends CreateRecord
{
    protected static string $resource = TripBusSpendResource::class;
    public function getTitle(): string
    {
        return 'Tambah Pengeluaran';
    }
}
