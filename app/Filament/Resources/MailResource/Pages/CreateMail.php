<?php

namespace App\Filament\Resources\MailResource\Pages;


use App\Filament\Resources\MailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMail extends CreateRecord
{
    protected static string $resource = MailResource::class;

    public function getTitle(): string
    {
        return 'Tambah Pesan';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Menambahkan template_chat otomatis berdasarkan input name, phone, dan email
        $data['template_chat'] = "Halo {$data['name']},\n"
            . "Terima kasih telah menghubungi kami. Kami akan segera menghubungi Anda di nomor {$data['phone']}"
            . ($data['email'] ? " atau melalui email {$data['email']}" : "") . ".\nPesan Anda: {$data['message']}";

        return $data;
    }
}
