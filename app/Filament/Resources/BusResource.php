<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Models\Bus;
use App\Models\BusImage;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Accordion;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;


class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    protected static ?string $pluralModelLabel = "Bus";

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 6;

    protected static ?string $slug = 'bus';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'license_plate'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var Order $record */

        return [
            'No. Plat' => optional($record)->license_plate,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereNull('deleted_at')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Group::make()
                            ->schema([
                                Forms\Components\Card::make()
                                    ->heading('Data Utama')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nama Bus')
                                            ->maxLength(24)
                                            ->placeholder('Masukan Nama Bus')
                                            ->required(),
                                        Forms\Components\TextInput::make('type')
                                            ->label('Jenis Bus')
                                            ->placeholder('Masukan Jenis Bus')
                                            ->required(),
                                        Forms\Components\TextInput::make('license_plate')
                                            ->label('Plat Nomor')
                                            ->placeholder('Masukan Plat Nomor')
                                            ->maxLength(16)
                                            ->required(),
                                        Forms\Components\TextInput::make('production_year')
                                            ->numeric()
                                            ->label('Tahun Produksi')
                                            ->placeholder('Masukan Tahun Produksi')
                                            ->maxLength(11)
                                            ->required(),
                                        Forms\Components\TextInput::make('color')
                                            ->label('Warna')
                                            ->placeholder('Masukan Warna')
                                            ->maxLength(24)
                                            ->required(),
                                        Forms\Components\TextInput::make('machine_number')
                                            ->label('Nomor Mesin')
                                            ->placeholder('Masukan Nomor Mesin')
                                            ->maxLength(255)
                                            ->required(),
                                        Forms\Components\TextInput::make('chassis_number')
                                            ->label('Nomor Chasis')
                                            ->placeholder('Masukan Nomor Chasis')
                                            ->maxLength(255)
                                            ->required(),
                                        Forms\Components\TextInput::make('capacity')
                                            ->label('Kapasitas Penumpang')
                                            ->placeholder('Masukan Kapasitas Penumpang')
                                            ->numeric()
                                            ->maxLength(11)
                                            ->required(),
                                        Forms\Components\TextInput::make('baggage')
                                            ->label('Bagasi')
                                            ->placeholder('Masukan Bagasi')
                                            ->numeric()
                                            ->maxLength(11)
                                            ->required(),
                                        Forms\Components\Select::make('ms_buses_id')
                                            ->label('Status Bus')
                                            ->default(1)
                                            ->relationship('ms_buses', 'name')
                                            ->required(),
                                    ])
                                    ->columns(3), // Mengatur jumlah kolom dalam card

                                Forms\Components\Repeater::make('images')
                                    ->label('Gambar Bus')
                                    ->relationship('images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Silahkan unggah gambar dibawah ini')
                                            ->disk('public') // Tentukan disk penyimpanan
                                            ->directory('bus_images') // Direktori penyimpanan gambar
                                            ->image()
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']) // Format gambar yang diperbolehkan
                                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                                            ->visibility('public')
                                            ->maxSize(2048) // Maksimal ukuran gambar dalam KB
                                            ->required(),
                                    ])
                                    ->minItems(1)
                                    ->maxItems(5)
                                    ->columnSpanFull(), // Mengatur card agar se layar
                            ])
                    ])
                    ->columnSpan(3),

                Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            //->heading('Pajak')
                            ->schema([
                                Repeater::make('last_tax')
                                    ->label(' Pajak Terakhir')
                                    ->relationship('bustaxlast')
                                    ->live()
                                    ->schema([
                                        Group::make()
                                            ->schema([
                                                Forms\Components\Select::make('id_user')
                                                    ->label('Pelaksana')
                                                    ->required()
                                                    ->relationship('users', 'name')
                                                    ->options(function () {
                                                        return User::whereHas('roles', function ($query) {
                                                            $query->where('name', 'driver')
                                                                ->orWhere('name', 'admin');
                                                        })->pluck('name', 'id'); // Mengambil nama dan id user
                                                    })
                                                    ->placeholder('Pilih Pelaksana'),
                                                Forms\Components\DatePicker::make('date')
                                                    ->label('Tanggal Pajak')
                                                    ->required(),
                                                Forms\Components\DatePicker::make('expiration')
                                                    ->label('Tanggal Kadaluarsa STNK')
                                                    ->required(),
                                                Forms\Components\DatePicker::make('expiration_number_bus')
                                                    ->label('Tanggal Kadaluarsa Nomor Bus')
                                                    ->required(),
                                                Forms\Components\TextInput::make('nominal')
                                                    ->label('Biaya')
                                                    ->numeric()
                                                    ->required()
                                                    ->prefix('Rp')
                                                    ->placeholder('Masukkan biaya pajak'),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->maxLength(255)
                                                    ->columnSpan(2)
                                                    ->placeholder('Deskripsi singkat pajak'),
                                            ])
                                            ->columns(2),
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Silahkan unggah gambar dibawah ini')
                                            ->disk('public')
                                            ->directory('bus_taxes') // Direktori penyimpanan gambar
                                            ->image()
                                            ->visibility('public')
                                            ->maxSize(2048) // Maksimal ukuran gambar dalam KB
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']) // Format gambar yang diperbolehkan
                                            ->required()
                                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                                    ])
                                    ->maxItems(2)
                                    ->defaultItems(0)
                            ]),
                        Forms\Components\Card::make()
                            // ->heading('KIR')
                            ->schema([
                                Repeater::make('last_kir')
                                    ->label(' KIR Terakhir')
                                    ->relationship('buskirlast')
                                    ->live()
                                    ->schema([
                                        Group::make()
                                            ->schema([
                                                Forms\Components\Select::make('id_user')
                                                    ->label('Pelaksana')
                                                    ->required()
                                                    ->relationship('users', 'name')
                                                    ->options(function () {
                                                        return User::whereHas('roles', function ($query) {
                                                            $query->where('name', 'driver')
                                                                ->orWhere('name', 'admin');
                                                        })->pluck('name', 'id'); // Mengambil nama dan id user
                                                    })
                                                    ->placeholder('Pilih Pelaksana'),
                                                Forms\Components\DatePicker::make('date_test')
                                                    ->label('Tanggal KIR')
                                                    ->required(),
                                                Forms\Components\DatePicker::make('expiration')
                                                    ->label('Tanggal Kadaluarsa KIR')
                                                    ->required(),
                                                Forms\Components\TextInput::make('nominal')
                                                    ->label('Biaya')
                                                    ->numeric()
                                                    ->required()
                                                    ->prefix('Rp')
                                                    ->placeholder('Masukkan biaya KIR'),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->columnSpan(2)
                                                    ->maxLength(255),
                                            ])
                                            ->columns(2),
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Gambar KIR')
                                            ->disk('public')
                                            ->directory('kir')
                                            ->visibility('public')
                                            ->maxSize(2048)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                                            ->required()
                                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                                            ->image(),
                                    ])
                                    ->maxItems(2)
                                    ->defaultItems(0)
                            ]),
                        Forms\Components\Card::make()
                            // ->heading('Perawatan')
                            ->schema([
                                Repeater::make('maintenance')
                                    ->label(' Perawatan Bus')
                                    ->relationship('maintenances3last')
                                    ->live()
                                    ->schema([
                                        Group::make()
                                            ->schema([
                                                Forms\Components\Select::make('id_user')
                                                    ->label('Pelaksana')
                                                    ->required()
                                                    ->relationship('users', 'name')
                                                    ->options(function () {
                                                        return User::whereHas('roles', function ($query) {
                                                            $query->where('name', 'driver')
                                                                ->orWhere('name', 'admin');
                                                        })->pluck('name', 'id'); // Mengambil nama dan id user
                                                    })
                                                    ->placeholder('Pilih Pelaksana'),
                                                Forms\Components\Select::make('id_m_maintenance')
                                                    ->label('Jenis Perawatan')
                                                    ->relationship('m_maintenances', 'name')
                                                    ->required(),
                                                Forms\Components\DatePicker::make('date')
                                                    ->label('Tanggal Perawatan')
                                                    ->required(),
                                                Forms\Components\TextInput::make('nominal')
                                                    ->label('Biaya Perawatan')
                                                    ->numeric()
                                                    ->required()
                                                    ->prefix('Rp')
                                                    ->placeholder('Masukkan biaya perawatan'),
                                                Forms\Components\TextInput::make('location')
                                                    ->label('Lokasi Perawatan')
                                                    ->required()
                                                    ->columnSpan(2)
                                                    ->placeholder('Masukkan Lokasi'),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->maxLength(255)
                                                    ->columnSpan(2)
                                                    ->nullable(),
                                            ])
                                            ->columns(2),
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Gambar Bukti Perawatan')
                                            ->disk('public')
                                            ->directory('maintenance_images')
                                            ->image()
                                            ->visibility('public')
                                            ->maxSize(2048)
                                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                                            ->nullable(),
                                    ])
                                    ->defaultItems(0)
                            ]),
                    ])
                    ->columnSpan(2),
            ])
            ->columns(5);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('images.image')
                    ->label('Bus')
                    ->getStateUsing(fn(Model $record) => optional($record->images->first())->image) // Ambil gambar pertama
                    ->size(50) // Ukuran gambar thumbnail
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Kode Bus')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('license_plate')
                    ->label('Plat Nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('production_year')
                    ->label('Tahun Produksi')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('color')
                    ->label('Warna')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Kapasitas')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ms_buses.name')
                    ->label('Status Bus')
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
                Tables\Filters\SelectFilter::make('ms_buses_id')
                    ->label('Status Bus')
                    ->relationship('ms_buses', 'name'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalWidth('7xl')
                    ->modalHeading('Lihat Bus'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalWidth('7xl')
                    ->modalHeading('Edit Bus')
                    ->modalButton('Simpan Perubahan'),
                Tables\Actions\ViewAction::make('manage')
                    ->label('Manajemen')
                    ->modalWidth('8xl')
                    ->icon('heroicon-m-calendar-days')
                    ->color('info')
                    ->form([
                        Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Bus'),
                                Forms\Components\TextInput::make('license_plate')
                                    ->label('Plat Nomor'),
                                Forms\Components\TextInput::make('production_year')
                                    ->numeric()
                                    ->label('Tahun Produksi'),
                                Forms\Components\Select::make('ms_buses_id')
                                    ->label('Status Bus')
                                    ->relationship('ms_buses', 'name'),
                            ])->columns(4),
                        Group::make()
                            ->schema([
                                Group::make()
                                    ->schema([
                                        Repeater::make('maintenances')
                                            ->label('Perawatan')
                                            ->relationship('maintenancesdesc')
                                            // ->collapsible()
                                            // ->collapsed()
                                            ->schema([
                                                Card::make()
                                                    ->collapsed()
                                                    ->collapsible()
                                                    ->heading(fn($record) => $record->m_maintenances->name . '  ->  ' . $record->date)
                                                    ->schema([
                                                        Forms\Components\Select::make('id_m_maintenance')
                                                            ->label('Jenis Perawatan')
                                                            ->reactive()
                                                            ->relationship('m_maintenances', 'name'),
                                                        Forms\Components\Select::make('id_user')
                                                            ->label('Pelaksana')
                                                            ->relationship('users', 'name'),
                                                        Forms\Components\DateTimePicker::make('date')
                                                            ->label('Tanggal'),
                                                        Forms\Components\TextInput::make('location')
                                                            ->label('Lokasi'),
                                                        Forms\Components\FileUpload::make('image')
                                                            ->label('Bukti Perawatan')
                                                            ->disk('public')
                                                            ->directory('maintenance_images')
                                                            ->image()
                                                            ->columnSpan(2)
                                                            ->visibility('public'),
                                                        Forms\Components\TextInput::make('nominal')
                                                            ->label('Biaya'),
                                                        Forms\Components\TextInput::make('description')
                                                            ->label('Deskripsi'),
                                                        Forms\Components\FileUpload::make('image_receipt')
                                                            ->label('Bukti Pembayaran')
                                                            ->disk('public')
                                                            ->directory('maintenance_receipts')
                                                            ->image()
                                                            ->columnSpan(2)
                                                            ->visibility('public'),
                                                    ])
                                                    ->columns(2)
                                            ])

                                    ])
                                    ->columnSpan(1),
                                Group::make()
                                    ->schema([
                                        Repeater::make('taxes')
                                            ->label('Pajak')
                                            ->relationship('taxdesc')
                                            // ->collapsible()
                                            ->schema([
                                                // Forms\Components\Select::make('id_user')
                                                //     ->label('Pelaksana')
                                                //     ->relationship('users', 'name'),
                                                // Forms\Components\DatePicker::make('date')
                                                //     ->label('Tanggal Pajak'),
                                                Card::make()
                                                    ->collapsible()
                                                    ->collapsed()
                                                    ->heading(fn($record) => $record->date . '  ->  ' . ($record->users)->name)
                                                    ->schema([
                                                        Forms\Components\Select::make('id_user')
                                                            ->label('Pelaksana')
                                                            ->relationship('users', 'name'),
                                                        Forms\Components\TextInput::make('nominal')
                                                            ->label('Biaya'),
                                                        Forms\Components\TextInput::make('description')
                                                            ->columnSpan(2)
                                                            ->label('Deskripsi'),
                                                        Forms\Components\DatePicker::make('expiration')
                                                            ->label('Kadaluarsa STNK'),
                                                        Forms\Components\DatePicker::make('expiration_number_bus')
                                                            ->label('Kadaluarsa Nomor Bus'),
                                                        Forms\Components\FileUpload::make('image')
                                                            ->label('Silahkan unggah gambar dibawah ini')
                                                            ->disk('public')
                                                            ->directory('bus_taxes') // Direktori penyimpanan gambar
                                                            ->image()
                                                            ->columnSpan(2)
                                                            ->visibility('public')
                                                            ->maxSize(2048) // Maksimal ukuran gambar dalam KB
                                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']) // Format gambar yang diperbolehkan
                                                            ->required(),
                                                    ])
                                                    ->columns(2)
                                            ])->columns(2)
                                    ])
                                    ->columnSpan(1),
                                Group::make()
                                    ->schema([
                                        Repeater::make('kir')
                                            ->label('KIR')
                                            ->relationship('kirdesc')
                                            // ->collapsible()
                                            ->schema([
                                                // Forms\Components\DatePicker::make('date_test')
                                                //     ->label('Tanggal Uji'),
                                                Card::make()
                                                    ->collapsible()
                                                    ->collapsed()
                                                    ->heading(fn($record) => $record->date_test . '  ->  ' . ($record->users)->name)
                                                    ->schema([
                                                        Forms\Components\Select::make('id_user')
                                                            ->label('Pelaksana')
                                                            ->relationship('users', 'name'),
                                                        Forms\Components\TextInput::make('nominal')
                                                            ->label('Biaya'),
                                                        Forms\Components\DatePicker::make('expiration')
                                                            ->label('Kadaluarsa KIR'),
                                                        Forms\Components\TextInput::make('description')
                                                            ->columnSpan(2)
                                                            ->label('Deskripsi'),
                                                        Forms\Components\FileUpload::make('image')
                                                            ->label('Gambar KIR')
                                                            ->disk('public')
                                                            ->columnSpan(2)
                                                            ->directory('kir')
                                                            ->visibility('public')
                                                            ->maxSize(2048)
                                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                                                            ->required()
                                                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                                                            ->image(),
                                                    ])
                                                    ->columns(2)
                                            ])->columns(2)
                                    ])
                                    ->columnSpan(1),
                            ])
                            ->columns(3)
                    ])
                    ->modalSubheading('Daftar semua perawatan, pajak, dan kir dalam bus')
                    // ->modalButton('Simpan')
                    //->requiresConfirmation()
                    ->modalIcon('heroicon-m-calendar-days')
                    ->modalHeading('Manajemen Bus'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])

            //         ->bulkActions([
            //             Tables\Actions\BulkActionGroup::make([
            //                 Tables\Actions\DeleteBulkAction::make()
            //                     ->label('Hapus')
            //                     ->action(function ($records) {
            //                         foreach ($records as $record) {
            //                             $record->delete(); // Menggunakan soft delete
            //                         }
            //                     }),
            //             ]),
            //         ]);
            // }

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
             'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }
}
