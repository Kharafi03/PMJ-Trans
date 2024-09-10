<?php

namespace App\Filament\Resources\MIncomeResource\Pages;

use App\Filament\Resources\MIncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMIncome extends EditRecord
{
    protected static string $resource = MIncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
