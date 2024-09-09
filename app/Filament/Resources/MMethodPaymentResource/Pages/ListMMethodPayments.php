<?php

namespace App\Filament\Resources\MMethodPaymentResource\Pages;

use App\Filament\Resources\MMethodPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMMethodPayments extends ListRecords
{
    protected static string $resource = MMethodPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Metode'),
        ];
    }
}
