<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutcomeResource\Pages;
use App\Models\Outcome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OutcomeResource extends Resource
{
    protected static ?string $model = Outcome::class;

    protected static ?string $pluralModelLabel = "Pengeluaran";

    protected static ?string $navigationIcon = 'heroicon-c-arrow-trending-down';

    // protected static ?string $navigationGroup = 'Pengeluaran';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Group untuk Data Utama
                Forms\Components\Section::make()
                    ->columns(2) // 2 kolom untuk data utama
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\TextInput::make('id_m_outcome')
                            ->label('ID Outcome')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('id_m_method_payment')
                            ->label('ID Metode Pembayaran')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')
                            ->numeric(),
                        Forms\Components\DateTimePicker::make('datetime')
                            ->label('Tanggal dan Waktu'),
                    ]),

                // Group untuk Upload Bukti Pembayaran
                Forms\Components\Section::make()
                    ->heading('Unggah Bukti Pembayaran')
                    ->schema([
                        Forms\Components\FileUpload::make('image_receipt')
                            ->label('Bukti Pembayaran')
                            ->required()
                            ->image() // Harus berupa gambar
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->columnSpanFull(), // Mengatur agar mengambil seluruh lebar
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_m_outcome')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_m_method_payment')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('datetime')
                    ->dateTime()
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
                    ->modalHeading('Lihat Pengeluaran'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Pengeluaran')
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
            'index' => Pages\ListOutcomes::route('/'),
            'create' => Pages\CreateOutcome::route('/create'),
            // 'edit' => Pages\EditOutcome::route('/{record}/edit'),
        ];
    }
}
