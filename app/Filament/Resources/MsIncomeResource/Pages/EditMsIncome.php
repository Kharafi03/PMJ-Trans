<?php

namespace App\Filament\Resources\MsIncomeResource\Pages;

use App\Filament\Resources\MsIncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsIncome extends EditRecord
{
    protected static string $resource = MsIncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
