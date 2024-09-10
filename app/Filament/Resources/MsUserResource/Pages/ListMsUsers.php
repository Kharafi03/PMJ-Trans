<?php

namespace App\Filament\Resources\MsUserResource\Pages;

use App\Filament\Resources\MsUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsUsers extends ListRecords
{
    protected static string $resource = MsUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Status'),
        ];
    }
}
