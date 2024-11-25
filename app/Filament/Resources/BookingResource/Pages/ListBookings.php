<?php

namespace App\Filament\Resources\BookingResource\Pages;

use Filament\Actions;
use App\Models\Booking;
use App\Models\Destination;
use App\Exports\BookingsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\BulkAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BookingResource;
use Carbon\Carbon;
use Filament\Resources\Components\Tab;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    public function getTabs(): array
    {
        $currentDate = Carbon::now()->startOfDay();

        return [
            null => Tab::make(label: 'Semua')
                ->badge(fn() => Booking::count()),
            'current' => Tab::make(label: 'Saat Ini')
                ->badge(fn() => Booking::where('date_start', '<=', $currentDate)
                    ->where('date_end', '>=', $currentDate)
                    ->count())
                ->modifyQueryUsing(function ($query) use ($currentDate) {
                    return $query->where('date_start', '<=', $currentDate)
                        ->where('date_end', '>=', $currentDate);
                }),
            'new' => Tab::make(label: 'Baru')
                ->badge(fn() => Booking::where('id_ms_booking', 1)->count())
                ->modifyQueryUsing(function ($query) {
                    return $query->where('id_ms_booking', 1);
                }),
            // 'accept' => Tab::make(label: 'Diterima')
            //     ->badge(fn() => Booking::where('id_ms_booking', 2)->count())
            //     ->modifyQueryUsing(function ($query) {
            //         return $query->where('id_ms_booking', 2);
            //     }),
            // 'reject' => Tab::make(label: 'Ditolak')
            //     ->badge(fn() => Booking::where('id_ms_booking', 3)->count())
            //     ->modifyQueryUsing(function ($query) {
            //         return $query->where('id_ms_booking', 3);
            //     }),
            // 'cancel' => Tab::make(label: 'Dibatalkan')
            //     ->badge(fn() => Booking::where('id_ms_booking', 5)->count())
            //     ->modifyQueryUsing(function ($query) {
            //         return $query->where('id_ms_booking', 5);
            //     }),
            'done' => Tab::make(label: 'Selesai')
                ->badge(fn() => Booking::where('id_ms_booking', 4)->count())
                ->modifyQueryUsing(function ($query) {
                    return $query->where('id_ms_booking', 4);
                }),
        ];
    }

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
                    $destinations = $bookings->map(function ($booking) {
                        return Destination::where('id_booking', $booking->id)->get();
                    });
                    $pdf = Pdf::loadView('pdf.bookings', ['bookings' => $bookings, 'destinations' => $destinations]);

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
