<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripFinishedResource\Pages;
use App\Filament\Resources\TripFinishedResource\RelationManagers;
use App\Models\TripFinished;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripFinishedResource extends Resource
{
    protected static ?string $model = TripFinished::class;

    protected static ?string $pluralModelLabel = "Trip Selesai";

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationGroup = 'Manajemen Trip Bus';

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereNull('deleted_at')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2) // 2 kolom untuk data utama
                    ->heading('Data Trip')
                    ->schema([
                        Forms\Components\TextInput::make('id_booking')
                            ->required()
                            ->numeric()
                            ->label('ID Pemesanan'),
                        Forms\Components\TextInput::make('id_ms_trip_finished')
                            ->required()
                            ->numeric()
                            ->label('ID Trip Selesai'),
                        Forms\Components\TextInput::make('trip_value')
                            ->numeric()
                            ->label('Nilai Trip'),
                        Forms\Components\TextInput::make('total_spend')
                            ->numeric()
                            ->label('Total Pengeluaran'),
                        Forms\Components\TextInput::make('profit')
                            ->numeric()
                            ->label('Keuntungan'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_booking')
                    ->numeric()
                    ->label('ID Pemesanan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_ms_trip_finished')
                    ->numeric()
                    ->label('ID Trip Selesai')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trip_value')
                    ->numeric()
                    ->label('Nilai Trip')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_spend')
                    ->numeric()
                    ->label('Total Pengeluaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('profit')
                    ->numeric()
                    ->label('Keuntungan')
                    ->searchable()
                    ->sortable(),
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat Trip Selesai'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Trip Selesai')
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
            'index' => Pages\ListTripFinisheds::route('/'),
            'create' => Pages\CreateTripFinished::route('/create'),
            // 'edit' => Pages\EditTripFinished::route('/{record}/edit'),
        ];
    }
}
