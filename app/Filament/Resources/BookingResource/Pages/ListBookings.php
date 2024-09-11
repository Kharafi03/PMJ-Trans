<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkAction;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Booking'),

            // Tambahkan aksi untuk download semua data sebagai PDF
            Actions\Action::make('downloadAllPDF')
                ->label('Download PDF')
                ->action(function () {
                    // Mengambil semua data booking
                    $bookings = Booking::all();

                    // Render PDF dengan semua data booking
                    $pdf = Pdf::loadView('pdf.bookings', ['bookings' => $bookings]);

                    // Kembalikan respons untuk mengunduh file PDF
                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        "Data Booking PMJ Trans.pdf"
                    );
                })
                ->requiresConfirmation()
                ->color('info'),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            // Bulk Action untuk download data yang dipilih
            BulkAction::make('downloadSelectedPDF')
                ->label('Download Data Terpilih PDF')
                ->action(function (array $records) {
                    if (empty($records)) {
                        // Jika tidak ada data yang dipilih, tampilkan pesan kesalahan
                        $this->notify('danger', 'Tidak ada data yang dipilih.');
                        return;
                    }

                    // Ambil data yang dipilih berdasarkan ID yang terpilih
                    $bookings = Booking::whereIn('id', $records)->get();

                    if ($bookings->isEmpty()) {
                        $this->notify('danger', 'Tidak ada data booking yang ditemukan.');
                        return;
                    }

                    // Render PDF menggunakan view `pdf.bookings` dengan data yang dipilih
                    $pdf = Pdf::loadView('pdf.bookings', ['bookings' => $bookings]);

                    // Kembalikan respons untuk mengunduh file PDF dengan data yang dipilih
                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        "Selected-Bookings.pdf"
                    );
                })
                ->requiresConfirmation()
                ->color('info'),
        ];
    }
}
