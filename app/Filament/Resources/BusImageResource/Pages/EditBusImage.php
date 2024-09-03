<?php

namespace App\Filament\Resources\BusImageResource\Pages;

use App\Filament\Resources\BusImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusImage extends EditRecord
{
    protected static string $resource = BusImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
