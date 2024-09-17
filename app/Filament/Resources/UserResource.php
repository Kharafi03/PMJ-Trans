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

    // protected static ?string $navigationGroup = 'Pengguna';

    protected static ?int $navigationSort = 2;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Card pertama dengan Grid 2 kolom
                Forms\Components\Card::make()
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\Grid::make(2) // Membuat Grid dengan 2 kolom
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255)
                                    ->required(), //Nanti jika cust tidak wajib ini hanya sementara
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
                    ->heading('Unggah File')
                    ->schema([
                        Forms\Components\FileUpload::make('sim')
                            ->label('Silahkan unggah file dibawah ini')
                            ->disk('public')
                            ->directory('sim')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'])
                            ->helperText('Unggah SIM dalam format JPG, PNG atau PDF, maksimal ukuran 2MB.')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->required(),
                    ]),

                // Card dengan pilihan select, juga dengan Grid 2 kolom
                Forms\Components\Card::make()
                    ->heading('Informasi User')
                    ->schema([
                        Forms\Components\Grid::make(2) // Membuat Grid dengan 2 kolom
                            ->schema([
                                Forms\Components\Select::make('id_ms')
                                    ->label('Status User')
                                    ->relationship('msUsers', 'name')
                                    ->required(),
                                Forms\Components\Select::make('id_role')
                                    ->label('Peran')
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
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('permissions.role')
                    ->label('Peran')
                    ->searchable()
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
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat User'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit User')
                    ->modalButton('Simpan Perubahan'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
