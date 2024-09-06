<?php

namespace App\Filament\Resources\BusImageResource\Pages;

use App\Filament\Resources\BusImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBusImage extends CreateRecord
{
    protected static string $resource = BusImageResource::class;

    public function getTitle(): string
    {
        return 'Tambah Gambar';
    }
}
