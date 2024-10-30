<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use App\Models\Outcome;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
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

        // // Mengecek jika status pemesanan diubah menjadi 'Dibatalkan'
        // if ($this->record->ms_booking === 4) { // Pastikan 4 adalah status 'Dibatalkan'
        //     dd($this->record->ms_booking);
        //     Outcome::create([
        //         'id_m_outcome' => 1, // Sesuaikan dengan tipe pengeluaran yang relevan
        //         'id_booking' => $this->record->id, // Hubungkan dengan id booking
        //         'id_m_method_payment' => 1, // Sesuaikan dengan metode pembayaran yang relevan
        //         'description' => 'Pengeluaran akibat pembatalan booking ' . $this->record->booking_code,
        //         'nominal' => $this->record->nominal_perjalanan, // Nominal dari booking
        //         'datetime' => now(),
        //     ]);
        // }

        // Jika status pembayaran adalah 'DP belum dibayar' dan email DP belum dibayar belum dikirim
        if ($this->record->ms_payment->id == 2 && !$this->record->email_dp_belum_dibayar) {
            $user = User::where('id', $this->record->id_cus)->whereNotNull('email')->first();

            if ($user) {
                $booking = $this->record;
                $destinations = $this->record->destination;
                $setting = Setting::first();

                // Kirim email e-ticket kweepada customer
                Mail::send('vendor.mail.dpbelumdibayar-email', compact('booking', 'destinations', 'setting'), function ($message) use ($user, $booking) {
                    $message->to($user->email, $user->name)
                        ->subject('Pemesanan Diterima - PMJ Trans - ' . $booking->booking_code);
                });

                // Update kolom email_dp_belum_dibayar menjadi true
                $this->record->email_dp_belum_dibayar = 1;
                $this->record->save();
            }
        }

        // Jika status pembayaran adalah 'DP Dibayarkan' dan email DP dibayarkan belum dikirim
        if ($this->record->ms_payment->id == 3 && !$this->record->email_dp_dibayarkan) {
            $user = User::where('id', $this->record->id_cus)->whereNotNull('email')->first();

            if ($user) {
                $booking = $this->record;
                $destinations = $this->record->destination;
                $setting = Setting::first();

                // Kirim email e-ticket kepada customer
                Mail::send('vendor.mail.dpdibayarkan-email', compact('booking', 'destinations', 'setting'), function ($message) use ($user, $booking) {
                    $message->to($user->email, $user->name)
                        ->subject('DP Dibayarkan - PMJ Trans - ' . $booking->booking_code);
                });

                // Update kolom email_dp_dibayarkan menjadi true
                $this->record->email_dp_dibayarkan = 1;
                $this->record->save();
            }
        }

        // Jika status pembayaran adalah 'Lunas' dan email lunas belum dikirim
        if ($this->record->ms_payment->id == 4 && !$this->record->email_lunas) {
            $user = User::where('id', $this->record->id_cus)->whereNotNull('email')->first();

            if ($user) {
                $booking = $this->record;
                $destinations = $this->record->destination;
                $setting = Setting::first();

                // Kirim email e-ticket kepada customer
                Mail::send('vendor.mail.lunas-email', compact('booking', 'destinations', 'setting'), function ($message) use ($user, $booking) {
                    $message->to($user->email, $user->name)
                        ->subject('Pembayaran Lunas - PMJ Trans - ' . $booking->booking_code);
                });

                // Update kolom email_lunas menjadi true
                $this->record->email_lunas = 1;
                $this->record->save();
            }
        }

        // Jika status booking adalah 'Ditolak' dan email ditolak belum dikirim
        if ($this->record->ms_booking->id == 3 && !$this->record->email_ditolak) {
            $user = User::where('id', $this->record->id_cus)->whereNotNull('email')->first();

            if ($user) {
                $booking = $this->record;
                $destinations = $this->record->destination;
                $setting = Setting::first();

                // Kirim email e-ticket kepada customer
                Mail::send('vendor.mail.ditolak-email', compact('booking', 'destinations', 'setting'), function ($message) use ($user, $booking) {
                    $message->to($user->email, $user->name)
                        ->subject('Pemesanan Ditolak - PMJ Trans - ' . $booking->booking_code);
                });

                // Update kolom email_ditolak menjadi true
                $this->record->email_ditolak = 1;
                $this->record->save();
            }
        }

        // Jika status booking adalah 'Dibatalkan' dan email dibatalkan belum dikirim
        if ($this->record->ms_booking->id == 5 && !$this->record->email_dibatalkan) {
            $user = User::where('id', $this->record->id_cus)->whereNotNull('email')->first();
    
            if ($user) {
                $booking = $this->record;
                $destinations = $this->record->destination;
                $setting = Setting::first();
    
                // Kirim email e-ticket kepada customer
                Mail::send('vendor.mail.dibatalkan-email', compact('booking', 'destinations', 'setting'), function ($message) use ($user, $booking) {
                    $message->to($user->email, $user->name)
                        ->subject('Pemesanan Dibatalkan - PMJ Trans - ' . $booking->booking_code);
                });
    
                // Update kolom email_dibatalkan menjadi true
                $this->record->email_dibatalkan = 1;
                $this->record->save();
            }
        }
    }
    
}
