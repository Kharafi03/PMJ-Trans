<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MMaintenanceResource\Pages;
use App\Filament\Resources\MMaintenanceResource\RelationManagers;
use App\Models\MMaintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class MMaintenanceResource extends Resource
{
    protected static ?string $model = MMaintenance::class;

    protected static ?string $pluralModelLabel = "Tipe Perawatan";

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static ?string $navigationGroup = 'Bus';

    protected static ?string $navigationLabel = 'Tipe Perawatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make() // Membungkus komponen input di dalam card
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Perawatan Bus')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255)
                            ->required(),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                    ->label('Perawatan Bus')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->action(function (Model $record) {
                        $record->delete();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->action(function (Model $record) {
                            $record->delete();
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
            'index' => Pages\ListMMaintenances::route('/'),
            'create' => Pages\CreateMMaintenance::route('/create'),
            'edit' => Pages\EditMMaintenance::route('/{record}/edit'),
        ];
    }
}
