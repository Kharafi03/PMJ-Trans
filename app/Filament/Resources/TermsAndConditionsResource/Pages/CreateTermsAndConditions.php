<?php

namespace App\Filament\Resources\TermsAndConditionsResource\Pages;

use App\Filament\Resources\TermsAndConditionsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTermsAndConditions extends CreateRecord
{
    protected static string $resource = TermsAndConditionsResource::class;

    public function getTitle(): string
    {
        return 'Tambah Syarat dan Ketentuan';
    }
}
