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
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama')
                                    ->maxLength(255)
                                    ->placeholder('Masukan nama lengkap')
                                    ->required(),
                                Forms\Components\TextInput::make('number_phone')
                                    ->label('Nomor Telepon')
                                    ->numeric()
                                    ->maxLength(14)
                                    ->placeholder('Masukan nomor telephone')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255)
                                    ->placeholder('Masukan alamat email'),
                                Forms\Components\TextInput::make('address')
                                    ->label('Alamat')
                                    ->maxLength(255)
                                    ->placeholder('Masukan alamat tempat tinggal'),
                                Forms\Components\TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->revealable()
                                    ->maxLength(255)
                                    ->dehydrated(fn ($state) => filled($state)) // Password hanya dikirim jika ada isi
                                    ->placeholder('Password minimal 8 karakter. minimal 1 huruf besar, 1 angka, 1 karater spesial')
                                    ->nullable(), // Mengizinkan nilai kosong
                                Forms\Components\TextInput::make('nik')
                                    ->label('NIK')
                                    ->numeric()
                                    ->maxLength(16)
                                    ->placeholder('Masukan NIK dengan benar'),
                            ]),
                    ]),

                // Card untuk upload file SIM
                Forms\Components\Card::make()
                    ->heading('Unggah File SIM')
                    ->schema([
                        Forms\Components\FileUpload::make('sim')
                            ->label('Silahkan unggah file dibawah ini')
                            ->disk('public')
                            ->directory('sim')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->helperText('Unggah SIM dalam format JPG atau PNG maksimal ukuran 2MB.')
                            ->visibility('public')
                            ->maxSize(2048),
                    ]),

                // Card dengan pilihan select, juga dengan Grid 2 kolom
                Forms\Components\Card::make()
                    ->heading('Informasi User')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('id_ms')
                                    ->label('Status User')
                                    ->relationship('msUsers', 'name')
                                    ->required(),
                                Forms\Components\Select::make('roles')
                                    ->label('Peran')
                                    ->relationship('roles', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
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
                Tables\Columns\TextColumn::make('number_phone')
                    ->label('No. Hp')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Peran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('msUsers.name')
                    ->label('Status')
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
                Tables\Filters\SelectFilter::make('id_role')
                    ->label('Peran')
                    ->relationship('roles', 'name'),
                Tables\Filters\SelectFilter::make('id_ms')
                    ->label('Peran')
                    ->relationship('msUsers', 'name'),
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
            //'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
