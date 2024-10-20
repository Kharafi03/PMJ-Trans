<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
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
                                Forms\Components\TextInput::make('open_hours')
                                    ->required()
                                    ->label('Jam Buka'),
                                Forms\Components\TextInput::make('sosmed_ig')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Instagram'),
                                Forms\Components\TextInput::make('sosmed_fb')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Facebook'),
                                Forms\Components\TextInput::make('sosmed_yt')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Youtube'),
                            ]),
                        // Kolom Kedua: Deskripsi dan Konten
                        Forms\Components\Section::make('Deskripsi dan Konten')
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->required()
                                    ->label('Logo')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('setting') // Menyimpan file di folder 'logos'
                                    ->image() // Hanya menerima file gambar
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
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
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\ImageColumn::make('logo')
                            ->height('100%')
                            ->width('100%'),
                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\Layout\Stack::make([
                                Tables\Columns\TextColumn::make('name')
                                    ->weight(FontWeight::Bold),
                                Tables\Columns\TextColumn::make('email')
                                    ->color('gray')
                                    ->limit(30),
                                Tables\Columns\TextColumn::make('contact')
                                    ->color('gray')
                                    ->limit(30),
                            ]),
                        ])->space(1),
                        Tables\Columns\Layout\Panel::make([
                            Tables\Columns\Layout\Stack::make([
                                Tables\Columns\TextColumn::make('sosmed')
                                    ->default('Sosial Media')
                                    ->weight(FontWeight::Bold),
                                Tables\Columns\TextColumn::make('sosmed_ig')
                                    ->color('gray'),
                                Tables\Columns\TextColumn::make('sosmed_fb')
                                    ->color('gray'),
                                Tables\Columns\TextColumn::make('sosmed_yt')
                                    ->color('gray'),
                            ])->collapsible(),
                        ]),
                    ]),
                ])



                // Tables\Columns\TextColumn::make('name')
                //     ->label('Nama'),
                // Tables\Columns\TextColumn::make('email')
                //     ->label('Email'),
                // Tables\Columns\TextColumn::make('contact')
                //     ->label('Kontak'),
                // Tables\Columns\TextColumn::make('open_hours')
                //     ->label('Jam Buka'),
                // // Tables\Columns\TextColumn::make('sosmed_ig')
                // //     ->label('Instagram')
                // //     ->searchable(),
                // // Tables\Columns\TextColumn::make('sosmed_fb')
                // //     ->label('Facebook')
                // //     ->searchable(),
                // // Tables\Columns\TextColumn::make('deleted_at')
                // //     ->label('Tanggal dihapus')
                // //     ->dateTime()
                // //     ->sortable()
                // //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->label('Tanggal dibuat')
                //     ->dateTime()
                //     ->sortable(),
                //     //->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->label('Tanggal diubah')
                //     ->dateTime()
                //     ->sortable(),
                //     //->toggleable(isToggledHiddenByDefault: true),
            ])

            ->contentGrid([
                'md' => 1,
                'xl' => 1,
            ])

            ->paginated(false)

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
