<?php

namespace App\Filament\Resources\MsTripFinishedResource\Pages;

use App\Filament\Resources\MsTripFinishedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsTripFinisheds extends ListRecords
{
    protected static string $resource = MsTripFinishedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Status'),
        ];
    }
}
