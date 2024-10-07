<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Models\Bus;
use App\Models\BusImage;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
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
                                            ->required(),
                                        Forms\Components\TextInput::make('license_plate')
                                            ->label('Plat Nomor')
                                            ->maxLength(16)
                                            ->required(),
                                        Forms\Components\TextInput::make('production_year')
                                            ->numeric()
                                            ->label('Tahun Produksi')
                                            ->maxLength(11)
                                            ->required(),
                                        Forms\Components\TextInput::make('color')
                                            ->label('Warna')
                                            ->maxLength(24)
                                            ->required(),
                                        Forms\Components\TextInput::make('machine_number')
                                            ->label('Nomor Mesin')
                                            ->maxLength(255)
                                            ->required(),
                                        Forms\Components\TextInput::make('chassis_number')
                                            ->label('Nomor Chasis')
                                            ->maxLength(255)
                                            ->required(),
                                        Forms\Components\TextInput::make('capacity')
                                            ->label('Kapasitas')
                                            ->numeric()
                                            ->maxLength(11)
                                            ->required(),
                                        Forms\Components\TextInput::make('baggage')
                                            ->label('Bagasi')
                                            ->numeric()
                                            ->maxLength(11)
                                            ->required(),
                                        Forms\Components\Select::make('ms_buses_id')
                                            ->label('Status Bus')
                                            ->relationship('ms_buses', 'name')
                                            ->required(),
                                    ])
                                    ->columns(4), // Mengatur jumlah kolom dalam card

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
                                                    ->columnSpan(2)
                                                    ->prefix('Rp')
                                                    ->placeholder('Masukkan biaya pajak'),
                                            ])
                                            ->columns(2),
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
                                                    ->columnSpan(2)
                                                    ->prefix('Rp')
                                                    ->placeholder('Masukkan biaya KIR'),
                                            ])
                                            ->columns(2)
                                    ])
                                    ->maxItems(2)
                                    ->defaultItems(0)
                            ]),
                        Forms\Components\Card::make()
                            // ->heading('Perawatan')
                            ->schema([
                                Repeater::make('maintenance')
                                    ->label(' Perawatan Bus')
                                    ->relationship('maintenances')
                                    ->live()
                                    ->schema([
                                        Group::make()
                                        ->schema([
                                        Forms\Components\Select::make('id_user')
                                            ->label('Pelaksana')
                                            ->required()
                                            ->relationship('users', 'name')
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
                                        ])
                                        ->columns(2)
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
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Bus'),
                Tables\Columns\ImageColumn::make('images.image')
                    ->label('Gambar Bus')
                    ->getStateUsing(fn(Model $record) => optional($record->images->first())->image) // Ambil gambar pertama
                    ->size(50), // Ukuran gambar thumbnail
                Tables\Columns\TextColumn::make('license_plate')
                    ->label('Plat Nomor'),
                Tables\Columns\TextColumn::make('production_year')
                    ->label('Tahun Produksi'),
                Tables\Columns\TextColumn::make('color')
                    ->label('Warna'),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Kapasitas'),
                Tables\Columns\TextColumn::make('ms_buses.name')
                    ->label('Status Bus'),
                    Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Tanggal dihapus')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal diubah')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('ms_buses_id')
                    ->label('Status Bus')
                    ->relationship('ms_buses', 'name'),
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
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->delete(); // Menggunakan soft delete
                            }
                        }),
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
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            // 'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }
}
