<?php

namespace App\Filament\Resources\BusKirResource\Pages;

use App\Filament\Resources\BusKirResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusKirs extends ListRecords
{
    protected static string $resource = BusKirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah KIR'),
        ];
    }
}
