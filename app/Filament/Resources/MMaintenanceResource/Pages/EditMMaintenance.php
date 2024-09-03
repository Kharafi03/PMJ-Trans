<?php

namespace App\Filament\Resources\MMaintenanceResource\Pages;

use App\Filament\Resources\MMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMMaintenance extends EditRecord
{
    protected static string $resource = MMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
