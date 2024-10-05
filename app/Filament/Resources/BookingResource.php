<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Outcome;
use App\Models\TripBus;
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
                                ->required()
                                ->numeric()
                                ->label('Jumlah Penumpang'),

                            Group::make()
                                ->schema([
                                    Group::make()
                                        ->schema([
                                            Select::make('fleet_amount')
                                                ->required()
                                                ->options([
                                                    1 => '1 Bus',
                                                    2 => '2 Bus',
                                                    3 => '3 Bus',
                                                    4 => '4 Bus',
                                                    5 => '5 Bus',
                                                ])
                                                ->reactive()
                                                ->afterStateUpdated(function (Get $get, Set $set) {
                                                    $fleetAmount = $get('fleet_amount');
                                                    $set('maxItems', $fleetAmount);
                                                })
                                                ->label('Jumlah Bus'),
                                        ])
                                        ->columnSpan(2),
                                    Group::make()
                                        ->schema([
                                            Toggle::make('legrest')
                                                //->inlineLabel()
                                                ->label('Leg Rest')
                                                ->default(0),
                                        ])
                                        ->columnSpan(1)
                                        ->columns(1),

                                ])
                                ->columns(3),
                        ])->columns(2),
                        TextInput::make('description')
                            ->label('Deskripsi'),


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
                                            ->reactive()
                                            ->debounce(1500)
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

                Forms\Components\Group::make()
                    ->schema([
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
                                                            ->required()
                                                            ->label('Kode Bus'),
                                                    ])
                                                    ->columnSpan(2),
                                                Group::make()
                                                    ->schema([
                                                        Toggle::make('legrest')
                                                            //->inlineLabel()
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
                                                    ->required()
                                                    ->label('Driver'),

                                                Select::make('id_codriver')
                                                    ->relationship('codriver', 'name')
                                                    ->required()
                                                    ->label('Co-Driver'),
                                            ])
                                            ->columns(2),
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
                                        return $get('fleet_amount') ?? 1;
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
        return $table->columns([
            TextColumn::make('id')
                ->label('No')
                ->sortable(),
            BadgeColumn::make('ms_booking.name')
                ->label('Status')
                ->searchable()
                ->sortable()
                ->colors([
                    'info' => 'Draf',
                    'success' => 'Selesai',
                    'warning' => 'Diterima',
                    'danger' => 'Ditolak',
                    'gray' => 'Dibatalkan', 
                ])
                ->formatStateUsing(function ($state) {
                    return ucfirst($state);
                }),
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
            TextColumn::make('destination.name')
                ->label('Tujuan')
                ->getStateUsing(fn(Model $record) => optional($record->destination->last())->name)
                ->searchable()
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
            TextColumn::make('deleted_at')
                ->label('Tanggal dihapus')
                ->searchable()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')
               ->label('Tanggal dibuat')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
               ->label('Tanggal diubah')
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
                    ->modalWidth('7xl')
                    ->modalHeading('Lihat Booking'),
                EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Booking')
                    ->modalWidth('7xl')
                    ->modalButton('Simpan Perubahan'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
                Tables\Actions\ViewAction::make('pengeluaran')
                    ->color('info')
                    ->icon('heroicon-c-shopping-cart')
                    ->visible(fn($record) => $record->id_ms_booking === 2)
                    ->form([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('booking_code')
                                    ->label('Kode Booking')
                                    ->default(fn($record) => $record->booking_code)
                                    ->afterStateHydrated(function (callable $set, $state, $record) {
                                        if ($record && $record->booking) {
                                            $set('destination_point', $record->destination->last()->name);
                                        }
                                    })
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
                                            ->required()
                                            ->label(false),
                                    ]),
                            ])
                            ->columns([
                                'default' => 2,
                                'md' => 2,
                                'lg' => 4,
                                'xl' => 4,
                            ]),
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
                                            ->disabled(),

                                        TextInput::make('total_spend')
                                            ->label('Total Pengeluaran')
                                            ->disabled(),

                                        TextInput::make('km_start')
                                            ->label('Km Awal')
                                            ->disabled(),

                                        TextInput::make('km_end')
                                            ->label('Km Akhir')
                                            ->disabled(),

                                    ])
                                    ->columns([
                                        'default' => 2,
                                        'md' => 4,
                                        'lg' => 4,
                                        'xl' => 4,
                                    ]),

                                Forms\Components\Repeater::make('trip_bus_spend')
                                    ->label('Pengeluaran')
                                    ->relationship('tripbusspend')
                                    ->schema([
                                        Forms\Components\Group::make()
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
                                            ])
                                            ->columns([
                                                'default' => 2,
                                                'md' => 4,
                                                'lg' => 4,
                                                'xl' => 4,
                                            ]),
                                        Forms\Components\Group::make()
                                            ->schema([
                                                Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->disabled(),

                                                // Membuat Latitude dan Longitude berada di sebelah kanan Deskripsi
                                                Forms\Components\Group::make()
                                                    ->schema([
                                                        TextInput::make('latitude')
                                                            ->label('Latitude')
                                                            ->disabled(),

                                                        TextInput::make('longitude')
                                                            ->label('Longitude')
                                                            ->disabled(),
                                                    ])
                                                    ->columns(2), 
                                            ])
                                            ->columns(2) 
                                            ->columnSpan(4)
                                    ])
                            ])
                    ])
                    ->modalHeading('Pengeluaran Perjalanan')
                    // ->modalSubheading('Daftar semua pengeluaran dalam booking')
                    // ->modalButton('Simpan')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-c-shopping-cart')
                    ->modalWidth('7xl')
                    ->label('Spend'),
                Tables\Actions\Action::make('refund')
                    ->label('Refund')
                    ->color('info') 
                    ->icon('heroicon-s-receipt-refund')
                    ->action(function ($record, $data) {
                        Outcome::create([
                            'id_booking' => $record->id,
                            'id_m_outcome' => 1,
                            'check' => 0,
                            'nominal' => $data['nominal'],
                            'id_m_method_payment' => $data['id_m_method_payment'],
                            'description' => 'Refund for transaction Booking Code : ' . $record->booking_code,
                            'datetime' => now(),
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
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Refund Confirmation')
                    ->modalSubheading('Apakah Anda yakin ingin melakukan refund untuk transaksi ini?')
                    ->modalButton('Refund')
                    ->visible(fn($record) => $record->id_ms_booking === 5), // Kondisi menampilkan tombol
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
