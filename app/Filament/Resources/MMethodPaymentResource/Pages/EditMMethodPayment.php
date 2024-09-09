<?php

namespace App\Filament\Resources\MMethodPaymentResource\Pages;

use App\Filament\Resources\MMethodPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMMethodPayment extends EditRecord
{
    protected static string $resource = MMethodPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
