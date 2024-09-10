<?php

namespace App\Filament\Resources\MOutcomeResource\Pages;

use App\Filament\Resources\MOutcomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMOutcome extends EditRecord
{
    protected static string $resource = MOutcomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
