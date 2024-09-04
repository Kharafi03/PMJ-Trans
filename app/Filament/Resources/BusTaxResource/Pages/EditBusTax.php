<?php

namespace App\Filament\Resources\BusTaxResource\Pages;

use App\Filament\Resources\BusTaxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusTax extends EditRecord
{
    protected static string $resource = BusTaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
