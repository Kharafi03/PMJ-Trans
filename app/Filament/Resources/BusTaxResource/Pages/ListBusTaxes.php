<?php

namespace App\Filament\Resources\BusTaxResource\Pages;

use App\Filament\Resources\BusTaxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusTaxes extends ListRecords
{
    protected static string $resource = BusTaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pajak'),
        ];
    }
}
