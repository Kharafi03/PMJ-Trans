<?php

namespace App\Filament\Resources\BookingResource\Pages;

use Filament\Actions;
use App\Models\Booking;
use App\Exports\BookingsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\BulkAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BookingResource;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Booking'),

            // Aksi untuk download semua data sebagai PDF
            Actions\Action::make('downloadAllPDF')
                ->label('PDF')
                ->icon('heroicon-o-document') 
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
                ->color('danger'),

           // Aksi untuk import exvel
                \EightyNine\ExcelImport\ExcelImportAction::make()
                ->color('info')
                ->label("Import Excel")
                ->modalDescription(new HtmlString('Download Format Excel <a class="underline text-blue-600" href="/format_booking.xlsx">disini</a>')),

            // Aksi untuk export semua data ke Excel
            Actions\Action::make('exportExcel')
                ->label('Export Excel')
                ->icon('heroicon-o-arrow-up-on-square') 
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
