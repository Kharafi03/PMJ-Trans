<?php

namespace App\Filament\Resources\MsUserResource\Pages;

use App\Filament\Resources\MsUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMsUser extends CreateRecord
{
    protected static string $resource = MsUserResource::class;
    public function getTitle(): string
    {
        return 'Tambah Status';
    }
}
