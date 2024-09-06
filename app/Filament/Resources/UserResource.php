<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $pluralModelLabel = "User";

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Card pertama dengan Grid 2 kolom
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(2) // Membuat Grid dengan 2 kolom
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\TextInput::make('number_phone')
                                    ->label('Nomor Telepon')
                                    ->numeric()
                                    ->maxLength(14)
                                    ->required(),
                                Forms\Components\TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\TextInput::make('nik')
                                    ->label('NIK')
                                    ->numeric()
                                    ->maxLength(16)
                                    ->required(),
                            ]),
                    ]),

                // Card untuk upload file SIM
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\FileUpload::make('sim')
                            ->label('SIM')
                            ->disk('public')
                            ->directory('sim')
                            ->image()
                            ->visibility('public')
                            ->maxSize(2048)
                            ->required(),
                    ]),

                // Card dengan pilihan select, juga dengan Grid 2 kolom
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(2) // Membuat Grid dengan 2 kolom
                            ->schema([
                                Forms\Components\Select::make('id_ms')
                                    ->label('Status User')
                                    ->relationship('msUsers', 'name')
                                    ->required(),
                                Forms\Components\Select::make('id_role')
                                    ->label('Role')
                                    ->relationship('permissions', 'role')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('permissions.role')
                    ->label('Role')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
