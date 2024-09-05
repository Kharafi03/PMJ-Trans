<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MSpendResource\Pages;
use App\Filament\Resources\MSpendResource\RelationManagers;
use App\Models\MSpend;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MSpendResource extends Resource
{
    protected static ?string $model = MSpend::class;

    protected static ?string $pluralModelLabel = "Tipe Pengeluaran";

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'edit' => Pages\EditMSpend::route('/{record}/edit'),
        ];
    }
}
