<?php

namespace App\Filament\Resources\MsBusResource\Pages;

use App\Filament\Resources\MsBusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsBuses extends ListRecords
{
    protected static string $resource = MsBusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
