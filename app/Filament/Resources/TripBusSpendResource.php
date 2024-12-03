<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripBusSpendResource\Pages;
use App\Filament\Resources\TripBusSpendResource\RelationManagers;
use App\Models\TripBusSpend;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripBusSpendResource extends Resource
{
    protected static ?string $model = TripBusSpend::class;

    protected static ?string $pluralModelLabel = "Pengeluaran Trip";

    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-right';

    protected static ?string $navigationGroup = 'Manajemen Trip Bus';

    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'pengeluaran-trip';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Group untuk Data Utama
                Forms\Components\Section::make()
                    ->columns(2) // 2 kolom untuk data utama
                    ->heading('Data Pengeluaran')
                    ->schema([
                        Forms\Components\Select::make('id_trip_bus')
                            ->label('ID Trip Bus')
                            ->relationship('tripbus', 'id')
                            ->required(),
                        Forms\Components\Select::make('id_m_spend')
                            ->label('Jenis Pengeluaran')
                            ->relationship('mspend', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')->currencyMask(thousandSeparator: '.',decimalSeparator: ',',precision: 0)
                            ->numeric(),
                        Forms\Components\TextInput::make('kilometer')
                            ->label('Kilometer')
                            ->numeric(),
                        Forms\Components\DateTimePicker::make('datetime')
                            ->label('Tanggal dan Waktu'),
                        Forms\Components\TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric(),
                        Forms\Components\TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric(),
                    ]),

                // Group untuk Upload Bukti Pembayaran
                Forms\Components\Section::make()
                    ->heading('Unggah Bukti Pembayaran')
                    ->schema([
                        Forms\Components\FileUpload::make('image_receipt')
                            ->label('Bukti Pembayaran')
                            ->required()
                            ->disk('public')
                            ->directory('receipt_spend')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->image() // Menentukan bahwa yang diunggah harus berupa file gambar
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_trip_bus')
                    ->label('ID Trip Bus')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mspend.name')
                    ->label('Jenis')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->prefix(' Rp. ')
                    ->label('Nominal')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('kilometer')
                //     ->numeric()
                //     ->label('Kilometer')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('datetime')
                    ->dateTime()
                    ->label('Tanggal dan Waktu')
                    ->searchable()
                    ->sortable(),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat Pengeluaran Trip')
                    ->modalWidth('lg'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Pengeluaran Trip')
                    ->modalButton('Simpan Perubahan')
                    ->modalWidth('lg'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTripBusSpends::route('/'),
            'create' => Pages\CreateTripBusSpend::route('/create'),
            //  'edit' => Pages\EditTripBusSpend::route('/{record}/edit'),
        ];
    }
}
