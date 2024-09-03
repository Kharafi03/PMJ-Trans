<?php

namespace App\Filament\Resources\MMaintenanceResource\Pages;

use App\Filament\Resources\MMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMMaintenances extends ListRecords
{
    protected static string $resource = MMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
