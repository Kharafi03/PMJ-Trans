<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $pluralModelLabel = "Booking";

    protected static ?string $navigationIcon = 'heroicon-c-clipboard-document-list';

    protected static ?string $navigationGroup = 'Booking';

    protected static string $title = 'Buat Pemesanan';

    // Form configuration
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('booking_code')
                ->required()
                ->label('Kode Booking'),

            Select::make('id_cus')
                ->relationship('customer', 'name')
                ->label('Customer')
                ->required(),

            TextInput::make('destination')
                ->required()
                ->label('Tujuan'),

            TextInput::make('bus_capacity')
                ->required()
                ->numeric()
                ->label('Kapasitas Bus'),

            DatePicker::make('start_date')
                ->required()
                ->minDate(now())
                ->label('Tanggal Mulai'),

            DatePicker::make('end_date')
                ->required()
                ->label('Tanggal Selesai'),

            TextInput::make('pickup_point')
                ->required()
                ->label('Titik Jemput'),

            TimePicker::make('pickup_time')
                ->required()
                ->label('Waktu Jemput'),

            TextInput::make('bus_count')
                ->required()
                ->numeric()
                ->label('Jumlah Bus'),

            TextInput::make('total')
                ->required()
                ->numeric()
                ->label('Nominal Perjalanan'),

            TextInput::make('down_payment')
                ->required()
                ->numeric()
                ->label('Minimum DP'),

            Select::make('id_ms_payment')
                ->label('Status Pembayaran')
                ->relationship('ms_payment', 'id')
                ->required(),
        ]);
    }

    // Table configuration
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('booking_code')->label('Kode Booking'),
            TextColumn::make('customer.name')->label('Nama Customer'),
            TextColumn::make('destination')->label('Tujuan'),
            TextColumn::make('bus_capacity')->label('Kapasitas Bus'),
            TextColumn::make('start_date')->label('Tanggal Mulai'),
            TextColumn::make('end_date')->label('Tanggal Selesai'),
            TextColumn::make('pickup_point')->label('Titik Jemput'),
            TextColumn::make('pickup_time')->label('Waktu Jemput'),
            TextColumn::make('bus_count')->label('Jumlah Bus'),
            TextColumn::make('total')->label('Nominal Perjalanan'),
            TextColumn::make('down_payment')->label('Minimum DP'),
            TextColumn::make('driver.name')->label('Driver'),
            TextColumn::make('coDriver.name')->label('Co Driver'),
        ])
            ->filters([])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'), // List existing bookings
            'create' => Pages\CreateBooking::route('/create'), // Create new booking (form page)
            'edit' => Pages\EditBooking::route('/{record}/edit'), // Edit existing booking
        ];
    }
}
