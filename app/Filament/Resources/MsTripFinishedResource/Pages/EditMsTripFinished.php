<?php

namespace App\Filament\Resources\MsTripFinishedResource\Pages;

use App\Filament\Resources\MsTripFinishedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsTripFinished extends EditRecord
{
    protected static string $resource = MsTripFinishedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
