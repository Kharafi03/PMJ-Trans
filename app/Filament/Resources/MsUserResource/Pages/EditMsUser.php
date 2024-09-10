<?php

namespace App\Filament\Resources\MsUserResource\Pages;

use App\Filament\Resources\MsUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsUser extends EditRecord
{
    protected static string $resource = MsUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
