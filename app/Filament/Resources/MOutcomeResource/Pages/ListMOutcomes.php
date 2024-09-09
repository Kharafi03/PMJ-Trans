<?php

namespace App\Filament\Resources\MOutcomeResource\Pages;

use App\Filament\Resources\MOutcomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMOutcomes extends ListRecords
{
    protected static string $resource = MOutcomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Tipe'),
        ];
    }
}
