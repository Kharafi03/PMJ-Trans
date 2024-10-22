<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BookingResource;


class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $superAdmins = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->get();
        // dd($superAdmins);
        

        // Mengambil booking yang baru saja dibuat
        $booking = Booking::create($data);

        // Mengambil semua admin yang akan menerima notifikasi
       
        // Mengirim notifikasi ke semua admin
        foreach ($superAdmins as $admin) {
            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->sendToDatabase($admin);
        }
        return $booking;
    }
}
