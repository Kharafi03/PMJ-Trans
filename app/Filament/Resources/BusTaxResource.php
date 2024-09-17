<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusTaxResource\Pages;
use App\Filament\Resources\BusTaxResource\RelationManagers;
use App\Models\BusTax;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusTaxResource extends Resource
{
    protected static ?string $model = BusTax::class;

    protected static ?string $pluralModelLabel = "Pajak";

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    // protected static ?string $navigationGroup = 'Bus';

    protected static ?int $navigationSort = 17;

    public static function form(Form $form): Form
    {
        return $form
            // Menambahkan judul di card
            ->schema([
                Forms\Components\Card::make()
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\TextInput::make('id_bus')
                            ->label('ID Bus')
                            ->required()
                            ->numeric()
                            ->placeholder('Masukkan ID Bus'),
                        Forms\Components\TextInput::make('id_user')
                            ->label('ID User')
                            ->required()
                            ->numeric()
                            ->placeholder('Masukkan ID User'),
                        Forms\Components\TextInput::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255)
                            ->placeholder('Deskripsi singkat pajak'),
                        Forms\Components\DateTimePicker::make('date')
                            ->label('Tanggal Pajak')
                            ->required(),
                        Forms\Components\DateTimePicker::make('expiration')
                            ->label('Tanggal Expirasi')
                            ->required(),
                        Forms\Components\DateTimePicker::make('expiration_number_bus')
                            ->label('Tanggal Expirasi Nomor Bus')
                            ->required(),
                        Forms\Components\TextInput::make('cost')
                            ->label('Biaya')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('Masukkan biaya pajak'),
                    ])
                    ->columns(2), // Mengatur tampilan card menjadi dua kolom untuk lebih rapi

                Forms\Components\Card::make()
                    ->heading('Unggah Gambar Pajak')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Silahkan unggah gambar dibawah ini')
                            ->disk('public')
                            ->directory('bus_taxes') // Direktori penyimpanan gambar
                            ->image()
                            ->visibility('public')
                            ->maxSize(2048) // Maksimal ukuran gambar dalam KB
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']) // Format gambar yang diperbolehkan
                            ->required()
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                    ])
                    ->columnSpanFull(), // Mengatur card ini untuk menempati lebar penuh
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_bus')
                    ->numeric()
                    ->label('ID Bus')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_user')
                    ->numeric()
                    ->label('ID User')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->label('Tanggal Pajak')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiration')
                    ->dateTime()
                    ->label('Tanggal Expirasi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiration_number_bus')
                    ->dateTime()
                    ->label('Tanggal Expirasi Nomor Bus')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost')
                    ->money()
                    ->label('Biaya')
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
                    ->modalHeading('Lihat Pajak')
                    ->modalWidth('lg'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Pajak')
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
            'index' => Pages\ListBusTaxes::route('/'),
            'create' => Pages\CreateBusTax::route('/create'),
            //'edit' => Pages\EditBusTax::route('/{record}/edit'),
        ];
    }
}
