<?php

namespace App\Filament\Resources\MSpendResource\Pages;

use App\Filament\Resources\MSpendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMSpends extends ListRecords
{
    protected static string $resource = MSpendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Tipe'),
        ];
    }
}
