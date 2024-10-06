<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripBusResource\Pages;
use App\Filament\Resources\TripBusResource\RelationManagers;
use App\Models\Booking;
use App\Models\TripBus;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripBusResource extends Resource
{
    protected static ?string $model = TripBus::class;

    protected static ?string $pluralModelLabel = "Trip Bus";

    protected static ?string $navigationIcon = 'heroicon-c-globe-americas';

    protected static ?string $navigationGroup = 'Manajemen Trip Bus';

    protected static ?int $navigationSort = -3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->heading('Data Utama')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->columns(3) // Mengatur menjadi 3 kolom agar lebih ringkas
                                    ->schema([
                                        Forms\Components\Select::make('id_booking')
                                            ->label('Kode Booking')
                                            ->reactive()
                                            ->relationship('booking', 'booking_code')
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                $cus = Booking::find($state);
                                                if ($cus) {
                                                    $set('id_customer', $cus->id_cus);
                                                }
                                            })
                                            ->required(),
                                        Forms\Components\Select::make('id_bus')
                                            ->label('Bus')
                                            ->required()
                                            ->relationship('bus', 'name'),
                                        Forms\Components\Select::make('id_customer')
                                            ->label('Customer')
                                            ->disabled()
                                            ->afterStateHydrated(function (callable $set, $state, $record) {
                                                // Cek apakah sedang dalam proses edit
                                                if ($record && $record->booking) {
                                                    // Mengambil id_cus dari relasi booking untuk di-set ke field id_customer
                                                    $set('id_customer', $record->booking->id_cus);
                                                }
                                            })
                                            ->relationship('cus', 'name'),
                                        Forms\Components\Select::make('id_driver')
                                            ->label('Driver')
                                            ->required()
                                            ->relationship('driver', 'name'),
                                        Forms\Components\Select::make('id_codriver')
                                            ->label('Co-Driver')
                                            ->required()
                                            ->relationship('codriver', 'name'),
                                        Forms\Components\Select::make('id_ms_trip')
                                            ->label('Status Trip')
                                            ->required()
                                            ->relationship('ms_trip', 'name'),
                                    ]),
                                Repeater::make('spendtrip')
                                    ->label('Pengeluaran Trip')
                                    ->relationship('tripbusspend')
                                    ->live()
                                    //->columns(3)
                                    ->schema([
                                        Forms\Components\Section::make()
                                            ->columns(3)
                                            ->schema([
                                                Select::make('id_m_spend')
                                                    ->label('Jenis Pengeluaran')
                                                    ->relationship('mspend', 'name')
                                                    ->reactive()
                                                    ->required(),
                                                TextInput::make('kilometer')
                                                    ->label('Kilometer')
                                                    ->required()
                                                    ->numeric(),
                                                TextInput::make('nominal')
                                                    ->label('Nominal')
                                                    ->debounce(1500)
                                                    ->prefix('Rp.')
                                                    //->reactive()
                                                    ->required()
                                                    ->numeric(),
                                                DateTimePicker::make('datetime')
                                                    ->default(now())
                                                    ->required()
                                                    ->label('Tanggal dan Waktu'),
                                                TextInput::make('latitude')
                                                    ->label('Latitude')
                                                    ->numeric(),
                                                TextInput::make('longitude')
                                                    ->label('Longitude')
                                                    ->numeric(),
                                            ]),
                                        Textarea::make('description')
                                            ->label('Deskripsi')
                                            ->maxLength(255),
                                        Forms\Components\Section::make()
                                            ->heading('Unggah Bukti Pembayaran')
                                            ->schema([
                                                Forms\Components\FileUpload::make('image_receipt')
                                                    ->label('Bukti Pembayaran')
                                                    ->required()
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                                                    ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                                                    ->image() // Menentukan bahwa yang diunggah harus berupa file gambar
                                                    ->columnSpanFull(),
                                            ]),
                                    ])
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        self::updateTotal($get, $set);
                                        self::updateBBMTotal($get, $set);
                                    })

                            ])->columnSpan(2),
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->columns(2)
                                    ->heading('Data Perjalanan')
                                    ->schema([
                                        Forms\Components\TextInput::make('km_start')
                                            ->label('KM Awal')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('km_end')
                                            ->label('KM Akhir')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('nominal')
                                            ->label('Saldo')
                                            ->prefix('Rp.')
                                            ->numeric(),
                                    ]),
                                Forms\Components\Section::make()
                                    ->columns(1)
                                    ->heading('Data Pengeluaran')
                                    ->schema([
                                        Forms\Components\TextInput::make('total_spend')
                                            ->label('Total Pengeluaran')
                                            ->prefix('Rp.')
                                            ->readOnly()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('total_spend_bbm')
                                            ->label('Total Pengeluaran BBM')
                                            ->prefix('Rp.')
                                            ->readOnly()
                                            ->numeric(),
                                    ]),
                            ])
                            ->columnSpan(1)
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking.booking_code')
                    ->numeric()
                    ->label('Kode Booking')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bus.name')
                    ->numeric()
                    ->label('Bus')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cus.name')
                    ->numeric()
                    ->getStateUsing(fn(Model $record) => optional($record->booking->customer)->name)
                    ->label('Pelanggan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver.name')
                    ->numeric()
                    ->label('Driver')
                    ->sortable(),
                Tables\Columns\TextColumn::make('codriver.name')
                    ->numeric()
                    ->label('Co-Driver')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->label('Saldo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_spend')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->label('Total Pengeluaran')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat Tripp Bus'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalWidth('7xl')
                    ->modalHeading('Edit Trip Bus')
                    ->modalButton('Simpan Perubahan'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTripBuses::route('/'),
            'create' => Pages\CreateTripBus::route('/create'),
            // 'edit' => Pages\EditTripBus::route('/{record}/edit'),
        ];
    }
    public static function updateTotal(Get $get, Set $set): void
    {
        $spendtotal = collect($get('spendtrip'))
            ->pluck('nominal')
            ->filter()
            ->sum();

        $set('total_spend', number_format($spendtotal, 2, '.', ''));
    }

    public static function updateBBMTotal(Get $get, Set $set): void
    {
        $idbbm = 1;
        $bbmtotal = collect($get('spendtrip'))
        ->filter(function ($spend) use ($idbbm) {
            return $spend['id_m_spend'] == $idbbm;
        })
            ->pluck('nominal')
            ->filter()
            ->sum();

        $set('total_spend_bbm', number_format($bbmtotal, 2, '.', ''));
    }
}
