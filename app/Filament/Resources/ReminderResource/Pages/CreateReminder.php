<?php

namespace App\Filament\Resources\ReminderResource\Pages;

use App\Filament\Resources\ReminderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReminder extends CreateRecord
{
    protected static string $resource = ReminderResource::class;
    public function getTitle(): string
    {
        return 'Tambah Reminder';
    }
}
