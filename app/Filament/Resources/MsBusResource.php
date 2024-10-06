<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsBusResource\Pages;
use App\Filament\Resources\MsBusResource\RelationManagers;
use App\Models\MsBus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class MsBusResource extends Resource
{
    protected static ?string $model = MsBus::class;

    protected static ?string $pluralModelLabel = "Status Bus";

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Bus';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->label('Status Bus')
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
                    ->label('Status Bus')
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
                    ->modalHeading('Lihat Status Bus')
                    ->modalButton('Simpan Perubahan')
                    ->modalWidth('lg'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Status Bus')
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
            'index' => Pages\ListMsBuses::route('/'),
            'create' => Pages\CreateMsBus::route('/create'),
            // 'edit' => Pages\EditMsBus::route('/{record}/edit'),
        ];
    }
}
