<?php

namespace App\Filament\Resources\OutcomeResource\Pages;

use App\Filament\Resources\OutcomeResource;
use App\Models\Booking;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOutcome extends EditRecord
{
    protected static string $resource = OutcomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // protected function afterSave(): void
    // {
    //     $outcome_code = $this->record->outcome_code;
    //     $type_outcome = substr($outcome_code, 0, 3);

    //     if ($type_outcome = 'PMJ') {
    //         Booking::createOrUpdate(
    //             ['booking_code' => $outcome_code],
    //             [

    //             ]
    //         );
    //     }

    //     //dd($type_outcome);
    // }
}
