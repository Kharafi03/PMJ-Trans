<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransactionResource\Pages;
use App\Filament\Admin\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('trx_id')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextArea::make('address')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->maxLength(1024),

                Forms\Components\TextInput::make('total_amount')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),

                Forms\Components\TextInput::make('duration')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->numeric()
                    ->prefix('Days')
                    ->maxValue(255),

                Forms\Components\Select::make('product_id')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->searchable()  // Perbaikan dari searchalbe ke searchable
                    ->preload()
                    ->relationship('product', 'name'),

                Forms\Components\Select::make('store_id')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->searchable()  // Perbaikan dari searchalbe ke searchable
                    ->preload()
                    ->relationship('store', 'name'),

                Forms\Components\DatePicker::make('started_at')  // Perbaikan dari DatePickr ke DatePicker
                    ->required(),

                Forms\Components\DatePicker::make('ended_at')  // Perbaikan dari DatePickr ke DatePicker
                    ->required(),

                Forms\Components\Select::make('delivery_type')
                    ->options([
                        'pickup' => 'Pickup Store',
                        'home_delivery' => 'Home Delivery',
                    ])
                    ->required(),

                Forms\Components\FileUpload::make('proof')  // Perbaikan dari Froms ke Forms
                    ->required()
                    ->openable()
                    ->image(),

                Forms\Components\Select::make('is_paid')  // Perbaikan dari Froms ke Forms
                    ->options([
                        true => 'Paid',
                        false => 'Not Paid',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('trx_id')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->prefix('Rp '),

                Tables\Columns\IconColumn::make('is_paid')  // Perbaikan dari IconColumn:make ke IconColumn::make
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Sudah Bayar?'),

                Tables\Columns\TextColumn::make('product.name'),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
