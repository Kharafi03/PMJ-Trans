<?php

namespace App\Filament\Resources\BusImageResource\Pages;

use App\Filament\Resources\BusImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusImages extends ListRecords
{
    protected static string $resource = BusImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
