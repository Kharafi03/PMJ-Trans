<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MSpendResource\Pages;
use App\Models\MSpend;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class MSpendResource extends Resource
{
    protected static ?string $model = MSpend::class;

    protected static ?string $pluralModelLabel = 'Jenis Trip';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Manajemen Trip Bus';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('bbm')
                ->label('BBM')
                ->numeric()
                ->required(),

            TextInput::make('tol')
                ->label('Tol')
                ->numeric()
                ->required(),

            TextInput::make('parkir')
                ->label('Parkir')
                ->numeric()
                ->required(),

            TextInput::make('makan')
                ->label('Makan')
                ->numeric()
                ->required(),

            TextInput::make('darurat')
                ->label('Darurat')
                ->numeric()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bbm')
                    ->label('BBM')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tol')
                    ->label('Tol')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('parkir')
                    ->label('Parkir')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('makan')
                    ->label('Makan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('darurat')
                    ->label('Darurat')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
                    ->modalHeading('Lihat Jenis Trip')
                    ->modalWidth('lg'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Jenis Trip')
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
            'index' => Pages\ListMSpends::route('/'),
            'create' => Pages\CreateMSpend::route('/create'),
            //'edit' => Pages\EditMSpend::route('/{record}/edit'),
        ];
    }
}
