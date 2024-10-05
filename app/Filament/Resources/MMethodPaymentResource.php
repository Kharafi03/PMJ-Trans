<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MMethodPaymentResource\Pages;
use App\Filament\Resources\MMethodPaymentResource\RelationManagers;
use App\Models\MMethodPayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MMethodPaymentResource extends Resource
{
    protected static ?string $model = MMethodPayment::class;

    protected static ?string $pluralModelLabel = "Metode Pembayaran";

    protected static ?string $navigationIcon = 'heroicon-c-building-library';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label("Metode")
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Metode")
                    ->searchable(),
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
                    ->modalHeading('Lihat Metode Pembayaran')
                    ->modalWidth('lg'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Metode Pembayaran')
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
            'index' => Pages\ListMMethodPayments::route('/'),
            'create' => Pages\CreateMMethodPayment::route('/create'),
            // 'edit' => Pages\EditMMethodPayment::route('/{record}/edit'),
        ];
    }
}
