<?php

namespace App\Filament\Resources\MsIncomeResource\Pages;

use App\Filament\Resources\MsIncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsIncomes extends ListRecords
{
    protected static string $resource = MsIncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Status'),
        ];
    }
}
