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
                        Forms\Components\Select::make('id_bus')
                            ->label('Bus')
                            ->required()
                            ->relationship('buses','name')
                            ->placeholder('Masukkan ID Bus'),
                        Forms\Components\Select::make('id_user')
                            ->label('User')
                            ->required()
                            ->relationship('users','name')
                            ->placeholder('Masukkan ID User'),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255)
                            ->columnSpan(2)
                            ->placeholder('Deskripsi singkat pajak'),
                        Forms\Components\DatePicker::make('date')
                            ->label('Tanggal Pajak')
                            ->required(),
                        Forms\Components\DatePicker::make('expiration')
                            ->label('Tanggal Kadaluarsa STNK')
                            ->required(),
                        Forms\Components\DatePicker::make('expiration_number_bus')
                            ->label('Tanggal Kadaluarsa Nomor Bus')
                            ->required(),
                        Forms\Components\TextInput::make('nominal')
                            ->label('Biaya')
                            ->numeric()
                            ->required()
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
                Tables\Columns\TextColumn::make('buses.name')
                    ->numeric()
                    ->label('Bus')
                    ->sortable(),
                Tables\Columns\TextColumn::make('users.name')
                    ->numeric()
                    ->label('Pelaksana')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('description')
                //     ->label('Deskripsi')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->label('Tanggal Pajak')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiration')
                    ->date()
                    ->label('Tgl Exp STNK')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiration_number_bus')
                    ->date()
                    ->label('Tgl Exp Nomor Bus')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->prefix('Rp. ')
                    ->label('Biaya')
                    ->sortable(),
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
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat Pajak')
                    ->modalWidth('5xl'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Pajak')
                    ->modalButton('Simpan Perubahan')
                    ->modalWidth('5xl'),
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
