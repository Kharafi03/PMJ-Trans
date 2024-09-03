<?php

namespace App\Filament\Resources\BusMaintenanceResource\Pages;

use App\Filament\Resources\BusMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusMaintenances extends ListRecords
{
    protected static string $resource = BusMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
