<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsTripFinishedResource\Pages;
use App\Filament\Resources\MsTripFinishedResource\RelationManagers;
use App\Models\MsTripFinished;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MsTripFinishedResource extends Resource
{
    protected static ?string $model = MsTripFinished::class;

    protected static ?string $pluralModelLabel = "Status Trip";

    protected static ?string $navigationIcon = 'heroicon-m-clipboard';

    protected static ?string $navigationGroup = 'Perjalanan Bus';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label("Nama")
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Nama")
                    ->searchable(),
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
                    ->modalHeading('Lihat Status Trip')
                    ->modalWidth('lg'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Status Trip')
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
            'index' => Pages\ListMsTripFinisheds::route('/'),
            'create' => Pages\CreateMsTripFinished::route('/create'),
            // 'edit' => Pages\EditMsTripFinished::route('/{record}/edit'),
        ];
    }
}
