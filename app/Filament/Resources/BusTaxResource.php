<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusTaxResource\Pages;
use App\Filament\Resources\BusTaxResource\RelationManagers;
use App\Models\BusTax;
use App\Models\Outcome;
use App\Models\User;
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

    protected static ?string $navigationGroup = 'Manajemen Bus';

    protected static ?int $navigationSort = -3;

    protected static ?string $slug = 'pajak';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\TextInput::make('tax_code')
                            ->label('Kode Pajak')
                            ->default(fn() => 'TAX-' . strtoupper(substr(str_shuffle(bin2hex(random_bytes(4)) . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8)))
                            ->required()
                            ->readOnly(),
                        Forms\Components\Select::make('id_bus')
                            ->label('Bus')
                            ->required()
                            ->relationship('buses', 'name')
                            ->placeholder('Masukkan ID Bus'),
                        Forms\Components\Select::make('id_user')
                            ->label('Pelaksana')
                            ->required()
                            ->relationship('users', 'name')
                            ->options(function () {
                                return User::whereHas('roles', function ($query) {
                                    $query->where('name', '!=', 'panel_user');
                                })->pluck('name', 'id'); // Mengambil nama dan id user
                            })
                            ->placeholder('Masukkan ID User'),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255)
                            ->columnSpan(3)
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
                        Forms\Components\Select::make('id_m_method_payment')
                            ->label('Metode Pembayaran')
                            ->relationship('m_method_payment', 'name')
                            ->required(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 3,
                    ]),

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
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tax_code')
                    ->label('Kode Pajak')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('buses.name')
                    ->numeric()
                    ->label('Bus')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('users.name')
                    ->numeric()
                    ->label('Pelaksana')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('description')
                //     ->label('Deskripsi')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->label('Tanggal Pajak')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('expiration')
                    ->date()
                    ->label('Tgl Exp STNK')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('expiration_number_bus')
                    ->date()
                    ->label('Tgl Exp Nomor Bus')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->prefix('Rp. ')
                    ->label('Biaya')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Tanggal Dihapus')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
                    ->action(function ($record) {
                        Outcome::where('outcome_code', $record->tax_code)->delete();
                        BusTax::where('id', $record->id)->delete();
                    })
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->paginated([25, 50, 100, 'all']);
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
            'edit' => Pages\EditBusTax::route('/{record}/edit'),
        ];
    }
}
