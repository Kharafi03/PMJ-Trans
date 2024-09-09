<?php

namespace App\Filament\Resources\MOutcomeResource\Pages;

use App\Filament\Resources\MOutcomeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMOutcome extends CreateRecord
{
    protected static string $resource = MOutcomeResource::class;

    public function getTitle(): string
    {
        return 'Tambah Tipe';
    }
}
