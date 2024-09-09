<?php

namespace App\Filament\Resources\TripBusSpendResource\Pages;

use App\Filament\Resources\TripBusSpendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTripBusSpends extends ListRecords
{
    protected static string $resource = TripBusSpendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pengeluaran'),
        ];
    }
}
