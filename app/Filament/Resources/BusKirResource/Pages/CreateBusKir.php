<?php

namespace App\Filament\Resources\BusKirResource\Pages;

use App\Filament\Resources\BusKirResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusKir extends CreateRecord
{
    protected static string $resource = BusKirResource::class;

    public function getTitle(): string
    {
        return 'Tambah KIR';
    }
}
