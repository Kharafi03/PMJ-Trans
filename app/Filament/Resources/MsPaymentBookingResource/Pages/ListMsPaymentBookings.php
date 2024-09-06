<?php

namespace App\Filament\Resources\MsPaymentBookingResource\Pages;

use App\Filament\Resources\MsPaymentBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsPaymentBookings extends ListRecords
{
    protected static string $resource = MsPaymentBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Status'),
        ];
    }
}
