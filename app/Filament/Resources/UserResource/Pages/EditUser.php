<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     // Jika password tidak diisi, hapus dari data agar password lama tetap digunakan
    //     if (empty($data['password'])) {
    //         unset($data['password']);
    //     } else {
    //         // Hash password baru jika ada input
    //         $data['password'] = Hash::make($data['password']);
    //     }

    //     return $data;
    // }
    
}
