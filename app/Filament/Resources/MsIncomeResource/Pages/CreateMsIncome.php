<?php

namespace App\Filament\Resources\MsIncomeResource\Pages;

use App\Filament\Resources\MsIncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMsIncome extends CreateRecord
{
    protected static string $resource = MsIncomeResource::class;

    public function getTitle(): string
    {
        return 'Tambah Status';
    }
}
