<?php

namespace App\Filament\Resources\MsBookingResource\Pages;

use App\Filament\Resources\MsBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsBookings extends ListRecords
{
    protected static string $resource = MsBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
