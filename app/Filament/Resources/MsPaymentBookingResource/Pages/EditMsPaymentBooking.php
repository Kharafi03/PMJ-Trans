<?php

namespace App\Filament\Resources\MsPaymentBookingResource\Pages;

use App\Filament\Resources\MsPaymentBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsPaymentBooking extends EditRecord
{
    protected static string $resource = MsPaymentBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
