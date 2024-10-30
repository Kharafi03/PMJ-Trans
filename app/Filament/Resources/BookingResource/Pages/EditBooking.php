<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use App\Models\Outcome;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
       
        // Mengecek jika status pemesanan diubah menjadi 'Dibatalkan'
        if ($this->record->ms_booking === 4) { // Pastikan 4 adalah status 'Dibatalkan'
            dd($this->record->ms_booking);
            Outcome::create([
                'id_m_outcome' => 1, // Sesuaikan dengan tipe pengeluaran yang relevan
                'id_booking' => $this->record->id, // Hubungkan dengan id booking
                'id_m_method_payment' => 1, // Sesuaikan dengan metode pembayaran yang relevan
                'description' => 'Pengeluaran akibat pembatalan booking ' . $this->record->booking_code,
                'nominal' => $this->record->nominal_perjalanan, // Nominal dari booking
                'datetime' => now(),
            ]);
        }

    }
}
