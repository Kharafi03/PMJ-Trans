<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Outcome;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Str;
//use Filament\Tables\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\DateTimePicker;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $pluralModelLabel = 'Booking';

    protected static ?string $navigationIcon = 'heroicon-c-shopping-bag';

    protected static ?int $navigationSort = 1;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Grid::make()->schema([
                // Bagian kiri form
                Forms\Components\Card::make()
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\Group::make()->schema([
                            TextInput::make('booking_code')
                                ->default(fn() => 'PMJ' . strtoupper(Str::random(4)) . rand(1000, 9999))
                                ->required()
                                ->readOnly()
                                ->label('Kode Booking'),
                            Select::make('id_cus')
                                ->relationship('customer', 'name')
                                ->searchable()
                                ->required()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('number_phone')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('email')
                                        ->email()
                                        ->maxLength(255)
                                        ->unique('users', 'email'),
                                ])
                                ->createOptionAction(function (Action $action) {
                                    return $action
                                        ->modalHeading('Tambah Customer')
                                        ->modalSubmitActionLabel('Tambah')
                                        ->modalWidth('lg')
                                        ->mutateFormDataUsing(function (array $data): array {
                                            // Menambahkan password default secara otomatis
                                            $data['password'] = bcrypt('12345678'); // Password default yang di-hash
                                            $data['id_ms'] = '1';

                                            return $data;
                                        });
                                }),

                            TextInput::make('pickup_point')
                                ->required()
                                ->label('Titik Jemput'),

                            TextInput::make('destination_point')
                                ->required()
                                ->label('Tujuan'),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            TextInput::make('fleet_amount')
                                ->required()
                                ->numeric()
                                ->label('Jumlah Bus'),

                            TextInput::make('capacity')
                                ->required()
                                ->numeric()
                                ->label('Kapasitas Bus'),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            DatePicker::make('date_start')
                                ->required()
                                ->minDate(now())
                                ->label('Tanggal Mulai'),

                            DatePicker::make('date_end')
                                ->required()
                                ->label('Tanggal Selesai'),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            TimePicker::make('pickup_time')
                                ->required()
                                ->label('Waktu Jemput'),

                            TimePicker::make('destination_time')
                                ->required()
                                ->label('Waktu Sampai'),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            TextInput::make('trip_nominal')
                                ->required()
                                ->numeric()
                                ->label('Nominal Perjalanan'),

                            TextInput::make('minimum_dp')
                                ->required()
                                ->numeric()
                                ->label('Minimum DP'),
                        ])->columns(2),
                    ])->columnSpan(2),  // Mengatur agar form ini berada di sebelah kiri, mencakup dua kolom

                // Card untuk status pembayaran di kanan
                Forms\Components\Card::make()
                    ->heading('Status')
                    ->schema([
                        Select::make('id_ms_payment')
                            ->label('Status Pembayaran')
                            ->relationship('ms_payment', 'name')
                            ->required(),
                    ])->columnSpan(1),  // Mengatur agar card ini berada di kolom kanan
            ])->columns(3),  // Menggunakan tiga kolom: dua untuk form kiri, satu untuk status pembayaran di kanan
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('booking_code')
                ->label('Kode Booking')
                ->searchable()
                ->sortable(),
            TextColumn::make('customer.name')
                ->label('Nama Customer')
                ->searchable()
                ->sortable(),
            TextColumn::make('pickup_point')
                ->label('Titik Jemput')
                ->searchable()
                ->sortable(),
            TextColumn::make('destination_point')
                ->label('Tujuan')
                ->searchable()
                ->sortable(),
            TextColumn::make('date_start')
                ->label('Tanggal Mulai')
                ->searchable()
                ->sortable(),
            TextColumn::make('ms_payment.name')
                ->label('Status Pembayaran')
                ->searchable()
                ->sortable(),
            TextColumn::make('ms_booking.name')
                ->label('Status')
                ->searchable()
                ->sortable(),
            TextColumn::make('deleted_at')
                ->label('Data dihapus')
                ->searchable()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_ms_payment')
                    ->label('Status Pembayaran')
                    ->relationship('ms_payment', 'name'),
                Tables\Filters\SelectFilter::make('id_ms_booking')
                    ->label('Status Pemesanan')
                    ->relationship('ms_booking', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat Booking'),
                EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Booking')
                    ->modalButton('Simpan Perubahan'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
        ];
    }
}
