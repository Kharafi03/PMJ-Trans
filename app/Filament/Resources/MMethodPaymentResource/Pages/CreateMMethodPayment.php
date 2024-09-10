<?php

namespace App\Filament\Resources\MMethodPaymentResource\Pages;

use App\Filament\Resources\MMethodPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMMethodPayment extends CreateRecord
{
    protected static string $resource = MMethodPaymentResource::class;
    public function getTitle(): string
    {
        return 'Tambah Metode';
    }
}
