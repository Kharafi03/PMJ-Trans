<?php

namespace App\Filament\Resources\MSpendResource\Pages;

use App\Filament\Resources\MSpendResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMSpend extends EditRecord
{
    protected static string $resource = MSpendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
