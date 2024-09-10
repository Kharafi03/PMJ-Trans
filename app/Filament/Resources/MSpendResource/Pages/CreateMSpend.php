<?php

namespace App\Filament\Resources\MSpendResource\Pages;

use App\Filament\Resources\MSpendResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMSpend extends CreateRecord
{
    protected static string $resource = MSpendResource::class;

    public function getTitle(): string
    {
        return 'Tambah Jenis';
    }
}
