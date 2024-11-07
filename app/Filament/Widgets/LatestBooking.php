<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class LatestBooking extends BaseWidget

{
    use HasWidgetShield;
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Booking Terbaru';


    public function table(Table $table): Table
    {
        return $table
            ->query(Booking::query()) // Query untuk mengambil data dari model Booking
            ->defaultPaginationPageOption(5) // Pagination default, menampilkan 5 booking per halaman
            ->defaultSort('created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking_code')
                    ->label('Kode Booking')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Nama Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pickup_point')
                    ->label('Titik Jemput')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('destination.name')
                    ->label('Tujuan')
                    ->getStateUsing(fn(Booking $record) => optional($record->destination->last())->name)
                    ->searchable()
                    ->limit(25)
                    ->tooltip(function (Booking $record) {
                        return ($record->destination->last())->name;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('ms_payment.name')
                    ->label('Status Pembayaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ms_payment.name')
                    ->label('Status Pembayaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Tanggal dihapus')
                    ->searchable()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal diedit')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ]);
            
    }
}
