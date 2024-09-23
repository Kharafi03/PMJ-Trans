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
use Filament\Forms\Components\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $pluralModelLabel = 'Booking';

    protected static ?string $navigationIcon = 'heroicon-c-shopping-bag';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make()->schema([
                // Bagian kiri form
                Forms\Components\Card::make()
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\Group::make()->schema([
                            TextInput::make('booking_code')
                                ->default(fn() => 'PMJ-' . strtoupper(Str::random(4)) . rand(1000, 9999))
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
                                        ->label('Nama')
                                        ->maxLength(255),
                                    TextInput::make('number_phone')
                                        ->required()
                                        ->label('Nomor Telephone')
                                        ->maxLength(255),
                                    TextInput::make('email')
                                        ->email()
                                        ->label('Alamat Email')
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
                        ])->columns(2),
                        Forms\Components\Group::make()->schema([
                            DateTimePicker::make('date_start')
                                ->required()
                                ->minDate(now())
                                ->label('Tanggal Mulai'),

                            DatePicker::make('date_end')
                                ->required()
                                ->minDate(now())
                                ->label('Tanggal Selesai'),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            TextInput::make('pickup_point')
                                ->required()
                                ->label('Titik Jemput'),

                            TextInput::make('destination_point')
                                ->required()
                                ->label('Tujuan'),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            TextInput::make('capacity')
                                ->required()
                                ->numeric()
                                ->label('Jumlah Penumpang'),
                            TextInput::make('fleet_amount')
                                ->required()
                                ->numeric()
                                ->label('Jumlah Bus'),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            TextInput::make('trip_nominal')
                                ->required()
                                ->prefix('Rp')
                                ->numeric()
                                ->label('Nominal Perjalanan'),

                            TextInput::make('minimum_dp')
                                ->required()
                                ->prefix('Rp')
                                ->numeric()
                                ->label('Minimum DP'),
                        ])->columns(2),
                        Forms\Components\Repeater::make('payment')
                            ->label('Pembayaran')
                            ->relationship('incomes')
                            ->live()
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        Select::make('id_m_income')
                                            ->relationship('m_income', 'name')
                                            ->required()
                                            ->label('Tipe'),
                                        Select::make('id_m_method_payment')
                                            ->relationship('m_method_payment', 'name')
                                            ->required()
                                            ->label('Metode'),
                                        Select::make('id_ms_income')
                                            ->relationship('ms_income', 'name')
                                            ->required()
                                            ->default(2)
                                            ->label('Status'),
                                    ])
                                    ->columns(3),
                                Forms\Components\Group::make()
                                    ->schema([
                                        TextInput::make('nominal')
                                            ->numeric()
                                            ->required()
                                            ->prefix('Rp.')
                                            ->label('Nominal'),
                                        DateTimePicker::make('datetime')
                                            ->readOnly()
                                            ->default(now()),
                                    ])
                                    ->columns(2),

                                Forms\Components\FileUpload::make('image_receipt')
                                    ->label('Silahkan unggah bukti pembayaran dibawah ini')
                                    ->disk('public') //
                                    ->directory('image_receipt')
                                    ->image()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                                    ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                                    ->visibility('public')
                                    ->maxSize(2048),
                            ])
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                self::updateReceivedRemaining($get, $set);
                            })
                            ->columnSpanFull(),

                        Forms\Components\Group::make()
                            ->schema([
                                TextInput::make('payment_received')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Rp.')
                                    ->label('Pembayaran Diterima'),

                                TextInput::make('payment_remaining')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Rp')
                                    ->label('Sisa Pembayaran'),
                            ])
                            ->columns(2),
                    ])->columnSpan(2),

                // Card untuk status pembayaran di kanan
                Forms\Components\Card::make()
                    ->heading('Status')
                    ->schema([
                        Select::make('id_ms_payment')
                            ->label('Status Pembayaran')
                            ->relationship('ms_payment', 'name')
                            ->default(1)
                            ->required(),
                        Select::make('id_ms_booking')
                            ->label('Status Pemesanan')
                            ->relationship('ms_booking', 'name')
                            ->default(2)
                            ->required(),
                    ])->columnSpan(1),  // Mengatur agar card ini berada di kolom kanan
            ])->columns(3),  // Menggunakan tiga kolom: dua untuk form kiri, satu untuk status pembayaran di kanan
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('id')
                ->label('No')
                ->sortable(),
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
                Tables\Actions\Action::make('refund')
                    ->label('Refund')
                    ->color('info') // Warna tombol
                    ->icon('heroicon-s-receipt-refund') // Ikon tombol
                    ->action(function ($record, $livewire) {
                        // Logika refund dengan model yang digunakan
                        // Menggunakan $record untuk akses data model
                        //Livewire::notify('success', 'Refund berhasil dilakukan!');
                        Outcome::create([
                            'id_booking' => $record->id,
                            'id_m_outcome' => 1,
                            'check' => 0,
                            'id_m_method_payment' => 1,
                            'description' => 'Refund for transaction Booking Code : ' . $record->booking_code, // Menambahkan deskripsi refund
                            'datetime' => now(), // Tanggal refund
                        ]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Refund Confirmation')
                    ->modalSubheading('Apakah Anda yakin ingin melakukan refund untuk transaksi ini?')
                    ->modalButton('Refund')
                    ->visible(fn($record) => $record->id_ms_booking === 4), // Kondisi menampilkan tombol
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

    public static function updateReceivedRemaining(Get $get, Set $set): void
    {
        $paymentReceived = collect($get('payment'))
            ->pluck('nominal')
            ->filter()
            ->sum();

        $tripNominal = $get('trip_nominal');

        $set('payment_received', number_format($paymentReceived, 2, '.', ''));

        $paymentRemaining = $tripNominal - $paymentReceived;

        $set('payment_remaining', number_format($paymentRemaining, 2, '.', ''));
    }
}
