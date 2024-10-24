<?php

namespace App\Filament\Resources\TermsAndConditionsResource\Pages;

use App\Filament\Resources\TermsAndConditionsResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;

class ListTermsAndConditions extends ListRecords
{
    protected static string $resource = TermsAndConditionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // public static function boot(): void
    // {
    //     parent::boot();

    //     Filament::serving(function () {
    //         Filament::registerStyles([ 
    //             '<style>
    //                 .tippy-box {
    //                     font-size: 14px;
    //                     max-width: 250px;
    //                     padding: 10px;
    //                 }
    //             </style>'
    //         ]);
    //     });
    // }
}
