<?php

namespace App\Filament\Resources\MsPaymentBookingResource\Pages;

use App\Filament\Resources\MsPaymentBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMsPaymentBooking extends CreateRecord
{
    protected static string $resource = MsPaymentBookingResource::class;

    public function getTitle(): string
    {
        return 'Tambah Status';
    }
}
