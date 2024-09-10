<?php

namespace App\Filament\Resources\MIncomeResource\Pages;

use App\Filament\Resources\MIncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMIncome extends CreateRecord
{
    protected static string $resource = MIncomeResource::class;

    public function getTitle(): string
    {
        return 'Tambah Tipe';
    }
}
