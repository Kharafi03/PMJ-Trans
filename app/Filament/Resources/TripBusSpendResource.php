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

    protected static ?string $navigationGroup = 'Perjalanan Bus';

    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form



    {
        return $form
            ->schema([
                // Group untuk Data Utama
                Forms\Components\Section::make()
                    ->columns(2) // 2 kolom untuk data utama
                    ->heading('Data Pengeluaran')
                    ->schema([
                        Forms\Components\TextInput::make('id_trip_bus')
                            ->label('ID Trip Bus')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('id_m_spend')
                            ->label('ID Pengeluaran')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')
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
            ->columns([
                Tables\Columns\TextColumn::make('id_trip_bus')
                    ->label('ID Trip Bus')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_m_spend')
                    ->label('ID Pengeluaran')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->label('Nominal')
                    ->sortable(),
                /*
                Tables\Columns\TextColumn::make('kilometer')
                    ->numeric()
                    ->label('Kilometer')
                    ->sortable(),
                Tables\Columns\TextColumn::make('datetime')
                    ->dateTime()
                    ->label('Tanggal dan Waktu')
                    ->sortable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->label('Latitude')
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->label('Longitude')
                    ->sortable(),
            */
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
            'index' => Pages\ListTripBusSpends::route('/'),
            'create' => Pages\CreateTripBusSpend::route('/create'),
            //  'edit' => Pages\EditTripBusSpend::route('/{record}/edit'),
        ];
    }
}