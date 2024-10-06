<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $pluralModelLabel = "Setting";

    protected static ?string $navigationIcon = 'heroicon-c-cog-8-tooth';

    protected static ?string $navigationGroup = 'Manajemen Sistem';

    protected static ?int $navigationSort = 24;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2) // Menggunakan dua kolom
                    ->schema([
                        // Kolom Pertama: Informasi Umum
                        Forms\Components\Section::make('Informasi Umum')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Nama'),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Email'),
                                Forms\Components\TextInput::make('contact')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Kontak'),
                                Forms\Components\TimePicker::make('open_hours')
                                    ->required()
                                    ->label('Jam Buka'),
                                Forms\Components\TextInput::make('sosmed_id')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Instagram'),
                                Forms\Components\TextInput::make('sosmed_fb')
                                    ->label('Facebook')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Facebook'),
                            ]),
                        // Kolom Kedua: Deskripsi dan Konten
                        Forms\Components\Section::make('Deskripsi dan Konten')
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->required()
                                    ->label('Logo')
                                    ->directory('logos') // Menyimpan file di folder 'logos'
                                    ->image() // Hanya menerima file gambar
                                    ->maxSize(2 * 1024) // Maksimum ukuran file 2MB
                                    ->helperText('Unggah logo (maksimal ukuran file: 2MB)'),
                                Forms\Components\Textarea::make('address')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Alamat'),
                                Forms\Components\Textarea::make('description')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Deskripsi'),
                                Forms\Components\Textarea::make('maps')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Link Google Maps'),
                                Forms\Components\Textarea::make('footer')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Footer'),
                                Forms\Components\Textarea::make('about_us')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Tentang Kami'),
                            ]),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact')
                    ->label('Kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('open_hours')
                    ->label('Jam Buka')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sosmed_id')
                    ->label('Instagram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sosmed_fb')
                    ->label('Facebook')
                    ->searchable(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),

        ];
    }
}
