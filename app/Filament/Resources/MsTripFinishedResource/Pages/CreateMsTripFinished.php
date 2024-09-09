<?php

namespace App\Filament\Resources\MsTripFinishedResource\Pages;

use App\Filament\Resources\MsTripFinishedResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMsTripFinished extends CreateRecord
{
    protected static string $resource = MsTripFinishedResource::class;
    public function getTitle(): string
    {
        return 'Tambah Status';
    }
}
