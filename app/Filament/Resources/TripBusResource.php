<?php

namespace App\Filament\Resources;

use App\Models\Bus;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Booking;
use App\Models\TripBus;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TripBusSpend;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\TripBusResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TripBusResource\RelationManagers;
use App\Filament\Resources\TripBusResource\Widgets\MyCalendar;

class TripBusResource extends Resource
{
    protected static ?string $model = TripBus::class;

    protected static ?string $pluralModelLabel = "Trip Bus";

    protected static ?string $navigationIcon = 'heroicon-c-globe-americas';

    protected static ?string $navigationGroup = 'Manajemen Trip Bus';

    protected static ?int $navigationSort = -3;

    protected static ?string $slug = 'trip-bus';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereNull('deleted_at')->count();
    }

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
                                        Select::make('id_booking')
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
                                        Select::make('id_bus')
                                            ->relationship('bus', 'name')
                                            ->options(function (Get $get, Set $set, $record) {
                                                if ($record && $record->booking) {
                                                    $tripStart = $record->booking->date_start;
                                                    $tripEnd = $record->booking->date_end;
                                                    $idBooking = $record->booking->id;
                                                    return self::getAvailableBuses($tripStart, $tripEnd, $idBooking);
                                                } else {
                                                    return Bus::pluck('name', 'id');
                                                }
                                                return [];
                                            })
                                            ->required()
                                            ->label('Bus'),
                                        Select::make('id_customer')
                                            ->label('Customer')
                                            ->disabled()
                                            ->afterStateHydrated(function (callable $set, $state, $record) {
                                                if ($record && $record->booking) {
                                                    $set('id_customer', $record->booking->id_cus);
                                                }
                                            })
                                            ->relationship('cus', 'name'),
                                        Select::make('id_driver')
                                            ->relationship('driver', 'name')
                                            ->options(function (Get $get, Set $set, $record) {
                                                if ($record && $record->booking) {
                                                    $tripStart = $record->booking->date_start;
                                                    $tripEnd = $record->booking->date_end;
                                                    $idBooking = $record->booking->id;
                                                    return self::getAvailableDriver($tripStart, $tripEnd, $idBooking);
                                                } else {
                                                    return User::whereHas('roles', function ($query) {
                                                        $query->where('name', 'Driver');
                                                    })->pluck('name', 'id');
                                                }
                                                return [];
                                            })
                                            ->required()
                                            ->label('Driver'),
                                        Select::make('id_codriver')
                                            ->relationship('codriver', 'name')
                                            ->reactive()
                                            ->options(function (Get $get, Set $set, $record) {
                                                if ($record && $record->booking) {
                                                    $tripStart = $record->booking->date_start;
                                                    $tripEnd = $record->booking->date_end;
                                                    $idBooking = $record->booking->id;
                                                    //dd($tripStart, $tripEnd, $idBooking);
                                                    return self::getAvailableDriver($tripStart, $tripEnd, $idBooking);
                                                } else {
                                                    return User::whereHas('roles', function ($query) {
                                                        $query->where('name', 'Driver');
                                                    })->pluck('name', 'id');
                                                }
                                                return [];
                                            })
                                            ->required()
                                            ->label('Driver'),
                                        Select::make('id_ms_trip')
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
                            ])->columnSpan(2),
                            
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->columns(2)
                                    ->heading('Data Perjalanan')
                                    ->schema([
                                        TextInput::make('km_start')
                                            ->label('KM Awal')
                                            ->numeric(),
                                        TextInput::make('km_end')
                                            ->label('KM Akhir')
                                            ->numeric(),
                                        TextInput::make('nominal')
                                            ->label('Saldo')
                                            ->columnSpan(2)
                                            //->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                                            // ->mask(
                                            //     fn(TextInput $mask) => $mask
                                            //         ->money(prefix: 'Rp. ', thousandsSeparator: '.', decimalSeparator: ',', precision: 0) // Atur mask untuk format ribuan
                                            // )
                                            ->prefix('Rp.')
                                            ->numeric(),
                                    ]),
                                Forms\Components\Section::make()
                                    ->columns(1)
                                    ->heading('Data Pengeluaran')
                                    ->schema([
                                        TextInput::make('total_spend')
                                            ->label('Total Pengeluaran')
                                            ->prefix('Rp.')
                                            ->readOnly()
                                            ->afterStateHydrated(function (Get $get, Set $set, $record) {
                                                if ($record && $record->id) {
                                                    self::updateTotal($get, $set, $record->id);
                                                }
                                            })
                                            ->numeric(),
                                        TextInput::make('total_spend_bbm')
                                            ->label('Total Pengeluaran BBM')
                                            ->prefix('Rp.')
                                            ->afterStateHydrated(function (Get $get, Set $set, $record) {
                                                if ($record && $record->id) {
                                                    self::updateBBMTotal($get, $set, $record->id);
                                                }
                                            })
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
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking.booking_code')
                    ->numeric()
                    ->label('Kode Booking')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bus.name')
                    ->numeric()
                    ->label('Bus')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cus.name')
                    ->numeric()
                    ->getStateUsing(fn(Model $record) => optional($record->booking->customer)->name)
                    ->label('Pelanggan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('driver.name')
                    ->label('Driver')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('codriver.name')
                    ->label('Co-Driver')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('booking.date_start')
                    ->sortable()
                    ->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->label('Saldo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_spend')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->label('Total Pengeluaran')
                    ->hidden()
                    //->visible(fn($record) => $record->id_ms_trip === 2 || 3)
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('ms_trip.name')
                    ->label('Status')
                    ->sortable()
                    ->colors([
                        'info' => 'Belum Perjalanan',
                        'warnings' => 'Dalam Perjalanan',
                        'success' => 'Selesai',
                    ])
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Tanggal Dihapus')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_ms_trip')
                    ->label('Status Perjalanan')
                    ->relationship('ms_trip', 'name'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalWidth('7xl')
                    ->modalHeading('Lihat Tripp Bus'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalWidth('7xl')
                    ->modalHeading('Edit Trip Bus')
                    ->modalButton('Simpan Perubahan'),
                Tables\Actions\EditAction::make('manage')
                    ->modalWidth('7xl')
                    ->color('info')
                    // ->action(function ($record, $data) {

                    //     // $totalSpend = $record->tripBusSpends()->sum('nominal');
                    //     // $record->update([
                    //     //     'total_spend' => $totalSpend,
                    //     // ]);
                    //     $totspend = 1000;
                    //     $totbbm = 1000;
                    //     dd($record->id);

                    //     TripBus::where('id', $record->id)->update([
                    //         'total_spend' => $totspend,
                    //         'total_spend_bbm' => $totbbm,
                    //     ]);
                    // })
                    ->form([
                        Group::make()
                            ->schema([
                                Select::make('id_driver')
                                    ->label('Driver')
                                    ->required()
                                    ->disabled()
                                    ->relationship('driver', 'name'),
                                Select::make('id_codriver')
                                    ->label('Co-Driver')
                                    ->required()
                                    ->disabled()
                                    ->relationship('codriver', 'name'),
                                TextInput::make('km_start')
                                    ->label('KM Awal')
                                    ->numeric(),
                                TextInput::make('km_end')
                                    ->label('KM Akhir')
                                    ->numeric(),
                                TextInput::make('nominal')
                                    ->label('Saldo')
                                    ->prefix('Rp.')
                                    ->numeric(),
                                TextInput::make('total_spend')
                                    ->label('Total Pengeluaran')
                                    ->prefix('Rp.')
                                    ->readOnly()
                                    ->afterStateHydrated(function (Get $get, Set $set, $record) {
                                        self::updateTotal($get, $set, $record->id);
                                    })
                                    ->reactive()
                                    ->numeric(),
                                TextInput::make('total_spend_bbm')
                                    ->label('Total Pengeluaran BBM')
                                    ->prefix('Rp.')
                                    ->readOnly()
                                    ->afterStateHydrated(function (Get $get, Set $set, $record) {
                                        self::updateBBMTotal($get, $set, $record->id);
                                    })
                                    ->reactive()
                                    ->numeric(),
                            ])
                            ->columns([
                                'default' => 1,
                                'md' => 2,
                                'lg' => 4,
                                'xl' => 4,
                            ]),

                        Repeater::make('listspend')
                            ->relationship('tripbusspend')
                            ->reactive()
                            ->label('Pengeluaran')
                            ->schema([
                                Forms\Components\Card::make()
                                    ->collapsed()
                                    ->heading(fn($record) => $record->mspend->name . ' => ' . $record->nominal)
                                    ->schema([
                                        Group::make()
                                            ->schema([
                                                Group::make()
                                                    ->schema([
                                                        Select::make('id_m_spend')
                                                            ->label('Tipe Pengeluaran')
                                                            ->relationship('mspend', 'name'),

                                                        TextInput::make('nominal')
                                                            ->label('Nominal')
                                                            ->prefix('Rp.')
                                                            // ->afterStateHydrated(function (Get $get, Set $set) {
                                                            //     self::updateTotal($get, $set);
                                                            // })
                                                            ->reactive(),

                                                        TextInput::make('kilometer')
                                                            ->label('Kilometer'),

                                                        TextInput::make('datetime')
                                                            ->label('Tanggal & Waktu'),

                                                        Textarea::make('description')
                                                            ->label('Deskripsi')
                                                            ->rows(1)
                                                            ->columnSpan([
                                                                'default' => 1,
                                                                'md' => 2,
                                                                'lg' => 2,
                                                                'xl' => 2,
                                                            ]),

                                                        TextInput::make('latitude')
                                                            ->label('Latitude'),

                                                        TextInput::make('longitude')
                                                            ->label('Longitude'),
                                                    ])
                                                    ->columnSpan([
                                                        'default' => 1,
                                                        'md' => 2,
                                                        'lg' => 3,
                                                        'xl' => 4,
                                                    ])
                                                    ->columns([
                                                        'default' => 1,
                                                        'md' => 2,
                                                        'lg' => 3,
                                                        'xl' => 4,
                                                    ]),
                                                Group::make()
                                                    ->schema([
                                                        Forms\Components\FileUpload::make('image_receipt')
                                                            ->label('Bukti Pembayaran')
                                                            ->required()
                                                            ->disk('public')
                                                            ->directory('receipt_spend')
                                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                                                            //->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                                                            ->image() // Menentukan bahwa yang diunggah harus berupa file gambar
                                                            ->columnSpanFull(),
                                                    ])
                                                    ->columns(1)

                                            ])
                                            ->columns(
                                                [
                                                    'default' => 1,
                                                    'md' => 3,
                                                    'lg' => 4,
                                                    'xl' => 5,
                                                ]
                                            )
                                    ])

                            ])
                    ])
                    ->modalButton('Simpan')
                    ->icon('heroicon-m-calendar-days')
                    ->modalHeading(fn($record) => 'Manajement Pengeluaran ' .  $record->bus->name)
                    ->label('Manajement'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->paginated([25, 50, 100, 'all']);
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getWidgets(): array
    {
        return [
           // MyCalendar::class,
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
    public static function updateTotal(Get $get, Set $set, $tripBusId): void
    {
        $spendtotal = TripBusSpend::where('id_trip_bus', $tripBusId)
            ->sum('nominal');

        $set('total_spend', number_format($spendtotal, 2, '.', ''));

        TripBus::where('id', $tripBusId)
            ->update([
                'total_spend' => $spendtotal,
            ]);
    }

    public static function updateBBMTotal(Get $get, Set $set, $tripBusId): void
    {
        $idbbm = 1;

        $bbmtotal = TripBusSpend::where('id_trip_bus', $tripBusId)
            ->where('id_m_spend', $idbbm)
            ->sum('nominal');

        $set('total_spend_bbm', number_format($bbmtotal, 2, '.', ''));

        TripBus::where('id', $tripBusId)
            ->update([
                'total_spend_bbm' => $bbmtotal,
            ]);
    }

    public static function getAvailableBuses($tripStart, $tripEnd, $idBooking)
    {
        if (!$tripStart || !$tripEnd) {
            return Bus::pluck('name', 'id');
        }

        return Bus::whereDoesntHave('tripbus.booking', function ($query) use ($tripStart, $tripEnd, $idBooking) {
            $query->where(function ($subQuery) use ($tripStart, $tripEnd) {
                $subQuery->where('date_start', '<=', $tripEnd)
                    ->where('date_end', '>=', $tripStart);
            });
            if ($idBooking) {
                $query->where('id_booking', '!=', $idBooking);
            }
        })->pluck('name', 'id');
    }

    public static function getAvailableDriver($tripStart, $tripEnd, $idBooking)
    {
        if (!$tripStart || !$tripEnd) {
            return User::whereHas('roles', function ($query) {
                $query->where('name', 'driver');
            })->pluck('name', 'id');
        }


        return User::whereHas('roles', function ($query) {
            $query->where('name', 'driver');
        })
            ->whereDoesntHave('driver', function ($query) use ($tripStart, $tripEnd, $idBooking) {
                $query->whereHas('booking', function ($subQuery) use ($tripStart, $tripEnd) {
                    $subQuery->where('date_start', '<=', $tripEnd)
                        ->where('date_end', '>=', $tripStart);
                });

                if ($idBooking) {
                    $query->where('id_booking', '!=', $idBooking);
                }
            })
            ->whereDoesntHave('codriver', function ($query) use ($tripStart, $tripEnd, $idBooking) {
                $query->whereHas('booking', function ($subQuery) use ($tripStart, $tripEnd) {
                    $subQuery->where('date_start', '<=', $tripEnd)
                        ->where('date_end', '>=', $tripStart);
                });

                if ($idBooking) {
                    $query->where('id_booking', '!=', $idBooking);
                }
            })
            ->pluck('name', 'id');
    }
}
