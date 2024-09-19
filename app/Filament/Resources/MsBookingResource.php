<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsBookingResource\Pages;
use App\Filament\Resources\MsBookingResource\RelationManagers;
use App\Models\MsBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;


class MsBookingResource extends Resource
{
    protected static ?string $model = MsBooking::class;

    protected static ?string $pluralModelLabel = "Status Booking";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Status';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Status Pemesanan')
                    ->maxLength(255)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            //
            Tables\Columns\TextColumn::make('name')
                ->label('Status Pemesanan')
                ->searchable()
                ->sortable(),
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
                ->modalHeading('Lihat List Status Pemesanan')
                ->modalButton('Simpan Perubahan')
                ->modalWidth('lg'),
            Tables\Actions\EditAction::make()
                ->label('Edit')
                ->modalHeading('Edit list Status Pemesanan')
                ->modalButton('Simpan Perubahan')
                ->modalWidth('lg'),
            Tables\Actions\DeleteAction::make()
                ->label('Hapus') // Ganti label jika diperlukan
                ->action(function (Model $record) {
                    $record->delete(); // Menggunakan soft delete
                }),
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
            'index' => Pages\ListMsBookings::route('/'),
            'create' => Pages\CreateMsBooking::route('/create'),
            'edit' => Pages\EditMsBooking::route('/{record}/edit'),
        ];
    }
}
