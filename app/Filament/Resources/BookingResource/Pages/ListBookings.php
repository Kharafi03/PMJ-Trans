<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkAction;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;
use App\Models\Booking;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Booking'),

            // Aksi untuk download semua data sebagai PDF
            Actions\Action::make('downloadAllPDF')
                ->label('Download PDF')
                ->action(function () {
                    $bookings = Booking::all();
                    $pdf = Pdf::loadView('pdf.bookings', ['bookings' => $bookings]);

                    return response()->stream(
                        function () use ($pdf) {
                            echo $pdf->output();
                        },
                        200,
                        [
                            'Content-Type' => 'application/pdf',
                            'Content-Disposition' => 'attachment; filename="Data Booking PMJ Trans.pdf"',
                        ]
                    );
                })
                ->requiresConfirmation()
                ->color('info'),

            // Aksi untuk export semua data ke Excel
            Actions\Action::make('exportExcel')
                ->label('Export Excel')
                ->action(function () {
                    return Excel::download(new BookingsExport(Booking::all()), 'bookings.xlsx');
                })
                ->color('warning'),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('downloadSelectedPDF')
                ->label('Download Data Terpilih PDF')
                ->action(function (array $records) {
                    if (empty($records)) {
                        $this->notify('danger', 'Tidak ada data yang dipilih.');
                        return;
                    }

                    $bookings = Booking::whereIn('id', $records)->get();
                    if ($bookings->isEmpty()) {
                        $this->notify('danger', 'Tidak ada data booking yang ditemukan.');
                        return;
                    }

                    $pdf = Pdf::loadView('pdf.bookings', ['bookings' => $bookings]);

                    return response()->stream(
                        function () use ($pdf) {
                            echo $pdf->output();
                        },
                        200,
                        [
                            'Content-Type' => 'application/pdf',
                            'Content-Disposition' => 'attachment; filename="Selected-Bookings.pdf"',
                        ]
                    );
                })
                ->requiresConfirmation()
                ->color('info'),

            // Aksi untuk export data terpilih ke Excel
            BulkAction::make('exportSelectedExcel')
                ->label('Export Data Terpilih Excel')
                ->action(function (array $records) {
                    if (empty($records)) {
                        $this->notify('danger', 'Tidak ada data yang dipilih.');
                        return;
                    }

                    return Excel::download(new BookingsExport(Booking::whereIn('id', $records)->get()), 'selected-bookings.xlsx');
                })
                ->color('success'),
        ];
    }
}
