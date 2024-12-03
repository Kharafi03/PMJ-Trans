<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\BookingMail;
use App\Models\Bus;
use App\Models\Outcome;
use App\Models\TripBus;
use App\Models\TripBusSpend;
use App\Models\User;
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
use Dompdf\FrameDecorator\Text;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use finfo;
use Illuminate\Database\Eloquent\Model;
use League\Flysystem\Visibility;
use Svg\Tag\Rect;
use Filament\Tables\Columns\BadgeColumn;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $pluralModelLabel = 'Booking';

    protected static ?string $navigationIcon = 'heroicon-c-shopping-bag';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'booking';

    protected $refresh = ['table.records' => 10];

    protected static ?string $recordTitleAttribute = 'booking_code';

    public static function getGloballySearchableAttributes(): array
    {
        return ['booking_code', 'customer.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var Order $record */

        return [
            'Penyewa' => optional($record->customer)->name,
            'Tujuan Akhir' => optional($record->destination->last())->name,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $newdraf = static::getModel()::where('id_ms_booking', 1)->count();
        if ($newdraf > 0) {
            return "{$newdraf}";
        }
        return "";
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

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
                                ->afterStateHydrated(function (Get $get, Set $set) {
                                    self::updateTripSpendTotal($get, $set, $get('id'));
                                    self::updateBookingSpendTotal($get, $set, $get('id'));
                                })
                                ->label('Kode Booking'),
                            Select::make('id_cus')
                                ->relationship('customer', 'name')
                                ->options(function () {
                                    return User::whereHas('roles', function ($query) {
                                        $query->where('name', 'panel_user');
                                    })->pluck('name', 'id');
                                })
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (Get $get, Set $set) {
                                    $cusss = $get('id_cus');
                                    $set('id_customer', $cusss);
                                })
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->label('Nama')
                                        ->maxLength(255),
                                    TextInput::make('number_phone')
                                        ->required()
                                        ->label('Nomor Telephone')
                                        ->unique('users', 'number_phone')
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
                                ->minDate(fn(Get $get) => ($get('id_ms_booking') === 2 &&  $get('id')) || $get('id_ms_booking') === 4 ? null : now())
                                ->reactive()
                                ->withoutSeconds()
                                ->label('Tanggal Mulai'),

                            DateTimePicker::make('date_end')
                                ->required()
                                ->minDate(fn(Get $get) => $get('date_start'))
                                ->default(fn(Get $get) => $get('date_start') ? \Carbon\Carbon::parse($get('date_start'))->endOfDay() : now()->endOfDay())
                                ->withoutSeconds()
                                ->reactive()
                                ->label('Tanggal Selesai'),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            TextInput::make('pickup_point')
                                ->required()
                                ->label('Titik Jemput'),

                            Forms\Components\Repeater::make('destination_point')
                                ->label('Tujuan')
                                ->relationship('destination')
                                ->live()
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->label('Destinasi'),
                                ])
                                ->minItems(1)
                                ->columnSpan(1),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            TextInput::make('capacity')
                                ->label('Jumlah Penumpang')
                                ->required()
                                ->numeric()
                                ->reactive()
                                ->debounce(1500)
                                ->afterStateUpdated(function (callable $get, callable $set) {
                                    $fleetAmount = $get('fleet_amount');
                                    $maxCapacity = $fleetAmount * 50;
                                    $set('maxCapacity', $maxCapacity);
                                })
                                // ->rule(function (callable $get, callable $set) {
                                //     $maxCapacity = $get('maxCapacity');
                                //     return "max:$maxCapacity";
                                // })
                                // ->validationAttribute('Jumlah Penumpang')
                                ->helperText(fn(callable $get) => 'Maksimal penumpang ' . $get('maxCapacity') . ' orang'),
                            // ->validationMessages([
                            //     'max' => 'Jumlah penumpang melebihi batas maksimum.',
                            // ]),

                            Group::make()
                                ->schema([
                                    Group::make()
                                        ->schema([
                                            Select::make('fleet_amount')
                                                ->required()
                                                ->options(function (Get $get) {
                                                    $startDate = $get('date_start');
                                                    $endDate = $get('date_end');
                                                    $idBooking = $get('id');
                                                    $availableBusCount = self::getAvailableBusCount($startDate, $endDate, $idBooking);
                                                    if ($availableBusCount === 0) {
                                                        return [0 => "Bus Tidak Tersedia"];
                                                    }
                                                    return collect(range(1, $availableBusCount))->mapWithKeys(fn($i) => [$i => "$i Bus"]);
                                                })
                                                ->reactive()
                                                ->afterStateUpdated(function (Get $get, Set $set) {
                                                    $fleetAmount = $get('fleet_amount');
                                                    $maxCapacity = $fleetAmount * 50;
                                                    $set('maxCapacity', $maxCapacity);
                                                    $set('maxItems', $fleetAmount);
                                                })
                                                ->label('Jumlah Bus'),
                                        ])
                                        ->columnSpan(2),
                                    Group::make()
                                        ->schema([
                                            Toggle::make('legrest')
                                                ->label('Leg Rest')
                                                ->default(0),
                                        ])
                                        ->columnSpan(1)
                                        ->columns(1),
                                ])
                                ->columns(3),
                        ])->columns(2),
                        TextInput::make('description')
                            ->reactive()
                            ->visible(fn(Get $get) => $get('legrest') == 1)
                            ->label('Deskripsi'),


                        Forms\Components\Group::make()->schema([
                            TextInput::make('trip_nominal')
                                ->required()
                                //->prefix('Rp')
                                ->numeric()
                                ->reactive()
                                //->afterStateUpdated(fn ($state, $set) => $set('trip_nominal', number_format($state, 0, ',', '.')))
                                ->label('Nominal Perjalanan'),

                            TextInput::make('minimum_dp')
                                ->required()
                                ->reactive()
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
                                            ->reactive()
                                            ->debounce(1500)
                                            ->prefix('Rp.')
                                            ->label('Nominal'),
                                        DateTimePicker::make('datetime')
                                            ->readOnly()
                                            ->label('Waktu Pembayaran')
                                            ->default(now()),
                                    ])
                                    ->columns(2),

                                Forms\Components\FileUpload::make('image_receipt')
                                    ->label('Silahkan unggah bukti pembayaran dibawah ini')
                                    ->disk('public') //
                                    ->directory('payment_image_receipt')
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
                                    ->afterStateHydrated(function (Get $get, Set $set) {
                                        self::updateReceivedRemaining($get, $set);
                                    })
                                    ->label('Pembayaran Diterima'),

                                TextInput::make('payment_remaining')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Rp')
                                    ->label('Sisa Pembayaran'),
                            ])
                            ->columns(2),
                        Forms\Components\Group::make()
                            ->visible(fn(Get $get) => $get('id_ms_booking') == 4)
                            ->reactive()
                            ->schema([
                                TextInput::make('total_booking_spend')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Rp.')
                                    ->label('Total Pengeluaran'),

                                TextInput::make('profit')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Rp')
                                    ->label('Keuntungan'),
                            ])
                            ->columns(2),
                    ])->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->heading('Status')
                            ->schema([
                                Select::make('id_ms_booking')
                                    ->label('Status Pemesanan')
                                    ->reactive()
                                    ->relationship('ms_booking', 'name')
                                    ->default(2)
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        self::updateReceivedRemaining($get, $set);
                                        self::updateStatusPayment($get, $set);
                                    })
                                    ->required(),
                                Select::make('id_ms_payment')
                                    ->label('Status Pembayaran')
                                    ->relationship('ms_payment', 'name')
                                    ->default(2)
                                    ->reactive()
                                    ->required(),

                            ])->columnSpan(1),

                        Forms\Components\Card::make()
                            ->heading('Pilih Bus')
                            ->schema([
                                Forms\Components\Repeater::make('choice_bus')
                                    ->label('Bus')
                                    ->relationship('tripbus')
                                    ->live()
                                    ->schema([
                                        Group::make()
                                            ->schema([
                                                Group::make()
                                                    ->schema([
                                                        Select::make('id_bus')
                                                            ->relationship('bus', 'name')
                                                            ->options(function (Get $get, Set $set, $record) {
                                                                $tripStart = $get('../../date_start');
                                                                $tripEnd = $get('../../date_end');
                                                                $idBooking = $get('../../id');
                                                                return self::getAvailableBuses($tripStart, $tripEnd, $idBooking);
                                                            })
                                                            ->required()
                                                            ->label('Kode Bus'),
                                                    ])
                                                    ->columnSpan(2),
                                                Group::make()
                                                    ->schema([
                                                        Toggle::make('legrest')
                                                            ->label('Leg Rest')
                                                            ->default(0),
                                                    ])
                                                    ->columnSpan(1)
                                                    ->columns(1),
                                            ])
                                            ->columns(3),
                                        Group::make()
                                            ->schema([
                                                Select::make('id_driver')
                                                    ->relationship('driver', 'name')
                                                    ->options(function (Get $get, Set $set, $record) {
                                                        $tripStart = $get('../../date_start');
                                                        $tripEnd = $get('../../date_end');
                                                        $idBooking = $get('../../id');
                                                        return self::getAvailableDriver($tripStart, $tripEnd, $idBooking);
                                                    })
                                                    ->required()
                                                    ->label('Driver'),

                                                Select::make('id_codriver')
                                                    ->relationship('codriver', 'name')
                                                    ->options(function (Get $get, Set $set, $record) {
                                                        $tripStart = $get('../../date_start');
                                                        $tripEnd = $get('../../date_end');
                                                        $idBooking = $get('../../id');
                                                        return self::getAvailableCrew($tripStart, $tripEnd, $idBooking);
                                                    })
                                                    ->required()
                                                    ->label('Co-Driver'),
                                            ])
                                            ->columns(2),
                                        TextInput::make('nominal')
                                            ->label('Saldo')
                                            ->prefix('Rp.')
                                            ->required(),
                                        Select::make('id_ms_trip')
                                            ->label('Status Trip')
                                            ->required()
                                            ->default(1)
                                            ->relationship('ms_trip', 'name'),
                                    ])
                                    ->minItems(0)
                                    ->maxItems(function (Get $get) {
                                        return $get('fleet_amount') ?? 1;
                                    })
                                    ->defaultItems(function (Get $get) {
                                        return $get('fleet_amount');
                                    })
                                    ->columnSpan(1),
                            ])->columnSpan(1),
                    ])
                    ->columns(1),
            ])
                ->columns(3)
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->defaultSort('updated_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                BadgeColumn::make('ms_booking.name')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->colors([
                        'warning' => 'Draf',
                        'info' => 'Selesai',
                        'success' => 'Diterima',
                        'danger' => 'Ditolak',
                        'danger' => 'Dibatalkan',
                    ])
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),
                TextColumn::make('booking_code')
                    ->label('Kode Booking')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pickup_point')
                    ->label('Titik Jemput')
                    ->searchable()
                    ->limit(25)
                    ->tooltip(function ($record) {
                        return $record->pickup_point;
                    })
                    ->sortable(),
                TextColumn::make('destination.name')
                    ->label('Tujuan')
                    ->getStateUsing(fn(Model $record) => optional($record->destination->last())->name)
                    ->searchable()
                    ->limit(25)
                    ->tooltip(function ($record) {
                        return ($record->destination->last())->name;
                    })
                    ->sortable(),
                BadgeColumn::make('ms_payment.name')
                    ->label('Pembayaran')
                    ->searchable()
                    ->sortable()
                    ->colors([
                        'info' => 'Draf',
                        'success' => 'Lunas',
                        'warning' => 'DP Dibayarkan',
                        'danger' => 'DP Belum Dibayar',
                    ])
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),
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
                Tables\Filters\SelectFilter::make('id_ms_payment')
                    ->label('Status Pembayaran')
                    ->relationship('ms_payment', 'name'),
                Tables\Filters\SelectFilter::make('id_ms_booking')
                    ->label('Status Pemesanan')
                    ->relationship('ms_booking', 'name'),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\ViewAction::make()
                    //->label('Lihat')
                    ->modalWidth('7xl')
                    ->modalHeading('Lihat Booking'),
                Tables\Actions\EditAction::make()
                    //->label('')
                    ->label('Edit')
                    ->modalHeading('Edit Booking')
                    ->modalWidth('7xl')
                    ->color('warning')
                    ->modalButton('Simpan Perubahan'),
                Tables\Actions\ViewAction::make('pengeluaran')
                    ->color('info')
                    ->icon('heroicon-c-shopping-cart')
                    ->visible(fn($record) => $record->id_ms_booking === 2 || $record->id_ms_booking === 4)
                    ->form([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('booking_code')
                                    ->label('Kode Booking')
                                    ->default(fn($record) => $record->booking_code)
                                    ->disabled(),
                                Forms\Components\Select::make('id_cus')
                                    ->label('Customer')
                                    ->relationship('customer', 'name')
                                    ->default(fn($record) => $record->customer->name)
                                    ->disabled(),
                                Forms\Components\TextInput::make('pickup_point')
                                    ->label('Titik Jemput')
                                    ->default(fn($record) => $record->pickup_point)
                                    ->disabled(),
                                Forms\Components\Repeater::make('destination_point')
                                    ->label('Tujuan')
                                    ->relationship('destination')
                                    ->live()
                                    ->schema([
                                        TextInput::make('name')
                                            ->label(false),
                                    ]),
                            ])
                            ->columns([
                                'default' => 1,
                                'md' => 2,
                                'lg' => 4,
                                'xl' => 4,
                            ]),
                        Forms\Components\Group::make()
                            ->visible(fn($record) => $record->id_ms_booking === 4)
                            ->reactive()
                            ->schema([
                                TextInput::make('trip_nominal')
                                    ->required()
                                    ->prefix('Rp')
                                    ->numeric()
                                    ->label('Nominal Perjalanan'),

                                TextInput::make('total_booking_spend')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Rp.')
                                    ->afterStateHydrated(function (Get $get, Set $set, $record) {
                                        self::updateBookingSpendTotal($get, $set, $record->id);
                                    })
                                    ->label('Total Pengeluaran'),

                                TextInput::make('profit')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Rp')
                                    ->label('Keuntungan'),
                            ])
                            ->columns(3),
                        Forms\Components\Repeater::make('listtripbus')
                            ->label('Pengeluaran Bus')
                            ->relationship('tripbus')
                            ->disabled()
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        TextInput::make('id')
                                            ->label('ID Trip')
                                            ->disabled(),

                                        Select::make('id_bus')
                                            ->label('Bus')
                                            ->relationship('bus', 'name')
                                            //->default(fn($record) => $record->destination->last()->name)
                                            ->disabled(),

                                        Select::make('id_driver')
                                            ->relationship('driver', 'name')
                                            ->required()
                                            ->label('Driver'),

                                        Select::make('id_codriver')
                                            ->relationship('codriver', 'name')
                                            ->required()
                                            ->label('Co-Driver'),

                                        TextInput::make('nominal')
                                            ->label('Saldo')
                                            ->prefix('Rp.')
                                            ->disabled(),

                                        TextInput::make('total_spend')
                                            ->label('Total Pengeluaran')
                                            ->afterStateHydrated(function (Get $get, Set $set, $record) {
                                                self::updateTripSpendTotal($get, $set, $record->id);
                                            })
                                            ->disabled(),

                                        TextInput::make('km_start')
                                            ->label('Km Awal')
                                            ->disabled(),

                                        TextInput::make('km_end')
                                            ->label('Km Akhir')
                                            ->disabled(),

                                    ])
                                    ->columns([
                                        'default' => 1,
                                        'md' => 3,
                                        'lg' => 4,
                                        'xl' => 4,
                                    ]),
                                Forms\Components\Card::make()
                                    ->heading(fn($record) => 'Pengeluaran ' .  $record->bus->name)
                                    ->collapsed()
                                    ->schema([
                                        Forms\Components\Repeater::make('trip_bus_spend')
                                            ->label('')
                                            ->relationship('tripbusspend')
                                            //->collapsed()
                                            ->schema([
                                                Group::make()
                                                    ->schema([
                                                        Group::make()
                                                            ->schema([
                                                                Select::make('id_m_spend')
                                                                    ->label('Tipe Pengeluaran')
                                                                    ->relationship('mspend', 'name')
                                                                    ->disabled(),

                                                                TextInput::make('nominal')
                                                                    ->label('Nominal')
                                                                    ->prefix('Rp.')
                                                                    ->disabled(),

                                                                TextInput::make('kilometer')
                                                                    ->label('Kilometer')
                                                                    ->disabled(),

                                                                TextInput::make('datetime')
                                                                    ->label('Tanggal & Waktu')
                                                                    ->disabled(),
                                                                Textarea::make('description')
                                                                    ->label('Deskripsi')
                                                                    ->rows(1)
                                                                    ->columnSpan([
                                                                        'default' => 1,
                                                                        'md' => 2,
                                                                        'lg' => 2,
                                                                        'xl' => 2,
                                                                    ])
                                                                    ->disabled(),
                                                                TextInput::make('latitude')
                                                                    ->label('Latitude')
                                                                    ->disabled(),
                                                                TextInput::make('longitude')
                                                                    ->label('Longitude')
                                                                    ->disabled(),
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
                                                        // Forms\Components\Group::make()
                                                        //     ->schema([])
                                                        //     ->columns(4)
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
                    ])
                    ->modalHeading('Pengeluaran Perjalanan')
                    ->modalSubheading('Daftar semua pengeluaran dalam booking')
                    // ->modalButton('Simpan')
                    //->requiresConfirmation()
                    ->modalIcon('heroicon-c-shopping-cart')
                    ->modalWidth('7xl')
                    ->label('Spend'),
                Tables\Actions\Action::make('refund')
                    ->label('Refund')
                    ->color('info')
                    ->icon('heroicon-s-receipt-refund')
                    ->action(function ($record, $data) {
                        Outcome::create([
                            'outcome_code' => $record->booking_code,
                            'id_m_outcome' => 1,
                            'check' => 1,
                            'image_receipt' => $data['image_receipt'],
                            'nominal' => $data['nominal'],
                            'id_m_method_payment' => $data['id_m_method_payment'],
                            'description' => 'Refund for transaction Booking Code : ' . $record->booking_code,
                            'datetime' => now(),
                        ]);


                        TripBus::where('id_booking', $record->id)
                            ->update([
                                'deleted_at' => now(),
                            ]);
                    })
                    ->form([
                        TextInput::make('nominal')
                            ->numeric()
                            ->prefix('Rp.')
                            ->required()
                            ->label('Nominal Refund'),
                        Select::make('id_m_method_payment')
                            ->relationship('m_method_payment', 'name')
                            ->required()
                            ->default(1)
                            ->label('Metode'),
                        Forms\Components\FileUpload::make('image_receipt')
                            ->label('Bukti Pembayaran')
                            ->required()
                            ->disk('public')
                            ->directory('outcomes_image_receipt')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->columnSpanFull()
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Refund Confirmation')
                    ->modalSubheading('Apakah Anda yakin ingin melakukan refund untuk transaksi ini?')
                    ->modalButton('Refund')
                    ->visible(fn($record) => $record->id_ms_booking === 5), // Kondisi menampilkan tombol
                Tables\Actions\Action::make('hubungi')
                    ->requiresConfirmation()
                    ->modalWidth('2xl')
                    ->modalHeading('Hubungi Penyewa')
                    ->modalSubheading('Apakah Anda yakin ingin mengirim pesan ini?')
                    ->modalButton('Kirim')
                    ->action(function ($record, $data) {
                        BookingMail::create([
                            'id_booking' => $record->id,
                            'message' => $data['message'],
                        ]);

                        $whatsappUrl = "https://wa.me/{$record->customer->number_phone}?text=" . urlencode($data['message']);

                        return redirect()->away($whatsappUrl);
                    })
                    ->form([
                        TextInput::make('name')
                            ->readOnly()
                            ->default(fn($record) => $record->customer->name)
                            ->label('Penyewa'),
                        Group::make()
                            ->schema([
                                TextInput::make('booking_code')
                                    ->readOnly()
                                    ->default(fn($record) => $record->booking_code)
                                    ->label('Kode Booking'),
                                TextInput::make('number_phone')
                                    ->readOnly()
                                    ->default(fn($record) => $record->customer->number_phone)
                                    ->label('No.Hp Penyewa'),
                            ])
                            ->columns(2),
                        TextArea::make('message')
                            ->required()
                            ->rows(5)
                            ->default(fn($get) => self::generateTemplateChat($get))
                            ->label('Pesan')
                    ])
                    ->color('success')
                    //->url(fn($record) => "https://wa.me/{$record->number_phone}?text=" . urlencode($record->message))
                    ->icon('heroicon-o-phone')
                    ->label('Hubungi'),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($record) {
                        Outcome::where('outcome_code', $record->maintenance_code)->delete();
                        Booking::where('id', $record->id)->delete();
                    })
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
        return [];
    }

    public static function generateTemplateChat($get)
    {
        $name = $get('name') ?? 'Pelanggan';
        $phone = $get('number_phone') ?? '(tidak ada nomor telepon)';
        $bookingcode = $get('booking_code') ?? '(tidak ada kode booking)';

        return "Halo {$name},\nTerima kasih atas pemesanan di PMJ-Trans. Kami menghubungi Anda di nomor telepon: {$phone}.\nDengan Kode Booking: {$bookingcode}. \n";
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit')
        ];
    }

    public static function updateStatusPayment(Get $get, Set $set): void
    {
        $statusbooking = $get('id_ms_booking');

        if ($statusbooking == 2) {
            $set('id_ms_payment', 2);
        }
    }

    public static function updateReceivedRemaining(Get $get, Set $set): void
    {
        $paymentReceived = collect($get('payment'))
            // ->filter(function ($payment) {
            //     return isset($payment['id_ms_income']) && $payment['id_ms_income'] === 2;
            // })
            ->where('id_ms_income', 2)
            ->pluck('nominal')
            ->filter()
            ->sum();

        $tripNominal = $get('trip_nominal');
        $minDp = $get('minimum_dp');

        $set('payment_received', number_format($paymentReceived, 2, '.', ''));

        $paymentRemaining = $tripNominal - $paymentReceived;

        $set('payment_remaining', number_format($paymentRemaining, 2, '.', ''));

        if ($tripNominal > 0) {
            if ($paymentReceived > $tripNominal - 1) {
                $set('id_ms_payment', 4);
            } else if ($paymentReceived >= $minDp) {
                $set('id_ms_payment', 3);
            } else {
                $set('id_ms_payment', 2);
            }
        }
    }

    public static function updateBookingSpendTotal(Get $get, Set $set, $bookingId): void
    {
        $bookingspendtotal = TripBus::where('id_booking', $bookingId)
            ->sum('total_spend');

        $tripNominal = $get('trip_nominal');
        $profit = $tripNominal - $bookingspendtotal;

        $set('profit', number_format($profit, 2, '.', ''));

        $set('total_booking_spend', number_format($bookingspendtotal, 2, '.', ''));

        Booking::where('id', $bookingId)
            ->update([
                'total_booking_spend' => $bookingspendtotal,
                'profit' => $profit,
            ]);
    }

    public static function updateTripSpendTotal(Get $get, Set $set, $tripBusId): void
    {
        $spendtotal = TripBusSpend::where('id_trip_bus', $tripBusId)
            ->sum('nominal');

        $set('total_spend', number_format($spendtotal, 2, '.', ''));

        TripBus::where('id', $tripBusId)
            ->update([
                'total_spend' => $spendtotal,
            ]);
    }

    public static function getAvailableBuses($tripStart, $tripEnd, $idBooking)
    {
        if (!$tripStart || !$tripEnd) {
            return Bus::pluck('name', 'id');
        }

        $tripEndTime = \Carbon\Carbon::parse($tripEnd)->endOfDay();

        return Bus::whereDoesntHave('tripbus.booking', function ($query) use ($tripStart, $tripEndTime, $idBooking) {
            $query->where(function ($subQuery) use ($tripStart, $tripEndTime) {
                $subQuery->where('date_start', '<=', $tripEndTime)
                    ->whereRaw("CAST(CONCAT(date_end, ' 23:59:59') AS DATETIME) >= ?", [$tripStart])
                    ->where('id_ms_booking', 2);
            });
            if ($idBooking) {
                $query->where('id_booking', '!=', $idBooking);
            }
        })->pluck('name', 'id');
    }

    public static function getAvailableBusCount($startDate, $endDate, $idBooking): int
    {
        if (!$startDate || !$endDate) {
            return Bus::count();
        }

        $tripEndTime = \Carbon\Carbon::parse($endDate)->endOfDay();

        $usedBusCount = Bus::whereHas('tripbus.booking', function ($query) use ($startDate, $tripEndTime, $idBooking) {
            $query->where(function ($subQuery) use ($startDate, $tripEndTime) {
                $subQuery->where('date_start', '<=', $tripEndTime)
                    ->whereRaw("CAST(CONCAT(date_end, ' 23:59:59') AS DATETIME) >= ?", [$startDate])
                    ->where('id_ms_booking', 2);
            });

            if ($idBooking) {
                $query->where('id_booking', '!=', $idBooking);
            }
        })->distinct('id')->count();

        $totalBusCount = Bus::count();
        $availableBusCount = max(0, $totalBusCount - $usedBusCount);

        return $availableBusCount;
    }


    public static function getAvailableDriver($tripStart, $tripEnd, $idBooking)
    {
        if (!$tripStart || !$tripEnd) {
            return User::whereHas('roles', function ($query) {
                $query->where('name', 'driver')
                    ->where('id_ms', 1);
            })->pluck('name', 'id');
        }

        $tripEndTime = \Carbon\Carbon::parse($tripEnd)->endOfDay();

        return User::whereHas('roles', function ($query) {
            $query->where('name', 'driver')
                ->where('id_ms', 1);
        })
            ->whereDoesntHave('driver', function ($query) use ($tripStart, $tripEndTime, $idBooking) {
                $query->whereHas('booking', function ($subQuery) use ($tripStart, $tripEndTime) {
                    $subQuery->where('date_start', '<=', $tripEndTime)
                        ->whereRaw("CAST(CONCAT(date_end, ' 23:59:59') AS DATETIME) >= ?", [$tripStart])
                        ->where('id_ms_booking', 2);
                });

                if ($idBooking) {
                    $query->where('id_booking', '!=', $idBooking);
                }
            })
            ->whereDoesntHave('codriver', function ($query) use ($tripStart, $tripEndTime, $idBooking) {
                $query->whereHas('booking', function ($subQuery) use ($tripStart, $tripEndTime) {
                    $subQuery->where('date_start', '<=', $tripEndTime)
                        ->whereRaw("CAST(CONCAT(date_end, ' 23:59:59') AS DATETIME) >= ?", [$tripStart])
                        ->where('id_ms_booking', 2);
                });

                if ($idBooking) {
                    $query->where('id_booking', '!=', $idBooking);
                }
            })
            ->pluck('name', 'id');
    }

    public static function getAvailableCrew($tripStart, $tripEnd, $idBooking)
    {
        if (!$tripStart || !$tripEnd) {
            return User::whereHas('roles', function ($query) {
                $query->where('name', 'kru')
                    ->where('id_ms', 1);
            })->pluck('name', 'id');
        }

        $tripEndTime = \Carbon\Carbon::parse($tripEnd)->endOfDay();

        return User::whereHas('roles', function ($query) {
            $query->where('name', 'kru')
                ->where('id_ms', 1);
        })
            ->whereDoesntHave('driver', function ($query) use ($tripStart, $tripEndTime, $idBooking) {
                $query->whereHas('booking', function ($subQuery) use ($tripStart, $tripEndTime) {
                    $subQuery->where('date_start', '<=', $tripEndTime)
                        ->whereRaw("CAST(CONCAT(date_end, ' 23:59:59') AS DATETIME) >= ?", [$tripStart])
                        ->where('id_ms_booking', 2);
                });

                if ($idBooking) {
                    $query->where('id_booking', '!=', $idBooking);
                }
            })
            ->whereDoesntHave('codriver', function ($query) use ($tripStart, $tripEndTime, $idBooking) {
                $query->whereHas('booking', function ($subQuery) use ($tripStart, $tripEndTime) {
                    $subQuery->where('date_start', '<=', $tripEndTime)
                        ->whereRaw("CAST(CONCAT(date_end, ' 23:59:59') AS DATETIME) >= ?", [$tripStart])
                        ->where('id_ms_booking', 2);
                });

                if ($idBooking) {
                    $query->where('id_booking', '!=', $idBooking);
                }
            })
            ->pluck('name', 'id');
    }
}
