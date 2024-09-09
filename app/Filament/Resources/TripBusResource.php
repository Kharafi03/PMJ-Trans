<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripBusResource\Pages;
use App\Filament\Resources\TripBusResource\RelationManagers;
use App\Models\TripBus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripBusResource extends Resource
{
    protected static ?string $model = TripBus::class;

    protected static ?string $pluralModelLabel = "Trip Bus";

    protected static ?string $navigationIcon = 'heroicon-c-globe-americas';

    protected static ?string $navigationGroup = 'Perjalanan Bus';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Group untuk Data Utama
                Forms\Components\Section::make()
                    ->columns(3) // Mengatur menjadi 3 kolom agar lebih ringkas
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\TextInput::make('id_booking')
                            ->label('ID Booking')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('id_bus')
                            ->label('ID Bus')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('id_customer')
                            ->label('ID Pelanggan')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('id_driver')
                            ->label('ID Driver')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('id_codriver')
                            ->label('ID Co-driver')
                            ->required()
                            ->numeric(),
                    ]),

                // Group untuk Data Perjalanan
                Forms\Components\Section::make()
                    ->columns(3) // Mengatur menjadi 3 kolom
                    ->heading('Data Perjalanan')
                    ->schema([
                        Forms\Components\TextInput::make('km_start')
                            ->label('KM Awal')
                            ->numeric(),
                        Forms\Components\TextInput::make('km_end')
                            ->label('KM Akhir')
                            ->numeric(),
                        Forms\Components\TextInput::make('balanced')
                            ->label('Saldo')
                            ->numeric(),
                    ]),

                // Group untuk Data Pengeluaran
                Forms\Components\Section::make()
                    ->columns(2) // Mengatur menjadi 2 kolom
                    ->heading('Data Pengeluaran')
                    ->schema([
                        Forms\Components\TextInput::make('total_spend')
                            ->label('Total Pengeluaran')
                            ->numeric(),
                        Forms\Components\TextInput::make('total_spend_bbm')
                            ->label('Total Pengeluaran BBM')
                            ->numeric(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_booking')
                    ->numeric()
                    ->label('ID Booking')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_bus')
                    ->numeric()
                    ->label('ID Bus')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_customer')
                    ->numeric()
                    ->label('ID Pelanggan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_driver')
                    ->numeric()
                    ->label('ID Driver')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_codriver')
                    ->numeric()
                    ->label('ID Co Driver')
                    ->sortable(),
                Tables\Columns\TextColumn::make('balanced')
                    ->numeric()
                    ->label('Saldo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('km_start')
                    ->numeric()
                    ->label('KM Awal')
                    ->sortable(),
                Tables\Columns\TextColumn::make('km_end')
                    ->numeric()
                    ->label('KM Akhir')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_spend')
                    ->numeric()
                    ->label('Total Pengeluaran')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_spend_bbm')
                    ->numeric()
                    ->label('Total Pengeluaran BBM')
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
}
