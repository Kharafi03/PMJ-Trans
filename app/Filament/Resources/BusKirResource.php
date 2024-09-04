<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusKirResource\Pages;
use App\Filament\Resources\BusKirResource\RelationManagers;
use App\Models\BusKir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusKirResource extends Resource
{
    protected static ?string $model = BusKir::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Bus';

    protected static ?string $navigationLabel = 'KIR Bus';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_bus')
                ->label('Bus')
                ->relationship('buses', 'name')
                ->required(),
            Forms\Components\Select::make('id_user')
                ->label('User')
                ->relationship('users', 'name') // Asumsikan ada relasi dengan User model
                ->required(),
            Forms\Components\TextInput::make('description')
                ->label('Deskripsi')
                ->maxLength(255),
            Forms\Components\DateTimePicker::make('date_test')
                ->label('Tanggal')
                ->required(),
            Forms\Components\DateTimePicker::make('expiration')
                ->label('Kadaluarsa')
                ->required(),
            Forms\Components\TextInput::make('cost')
                ->label('Biaya')
                ->numeric()
                ->prefix('Rp. '),
            Forms\Components\FileUpload::make('image')
                ->label('Gambar')
                ->disk('public')
                ->directory('stnk')
                ->visibility('public')
                ->maxSize(2048) // Maksimal ukuran gambar dalam KB
                ->required()
                ->image(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_bus')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_user')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_test')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiration')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost')
                    ->money()
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
            'index' => Pages\ListBusKirs::route('/'),
            'create' => Pages\CreateBusKir::route('/create'),
            'edit' => Pages\EditBusKir::route('/{record}/edit'),
        ];
    }
}
