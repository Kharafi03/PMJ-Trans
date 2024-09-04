<?php

namespace App\Filament\Resources\BusKirResource\Pages;

use App\Filament\Resources\BusKirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusKir extends EditRecord
{
    protected static string $resource = BusKirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
