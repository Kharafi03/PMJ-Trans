<?php

namespace App\Filament\Resources\MailResource\Pages;

use App\Filament\Resources\MailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMail extends EditRecord
{
    protected static string $resource = MailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['template_chat'] = "Halo {$data['name']},\n"
            . "Terima kasih telah menghubungi kami. Kami akan segera menghubungi Anda di nomor {$data['phone']}"
            . ($data['email'] ? " atau melalui email {$data['email']}" : "") . ".\nPesan Anda: {$data['message']}";

        return $data;
    }
}
