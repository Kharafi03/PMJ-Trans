<?php

namespace App\Filament\Resources\MIncomeResource\Pages;

use App\Filament\Resources\MIncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMIncomes extends ListRecords
{
    protected static string $resource = MIncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Tipe'),
        ];
    }
}
