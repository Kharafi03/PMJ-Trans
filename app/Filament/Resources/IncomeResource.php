<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeResource\Pages;
use App\Filament\Resources\IncomeResource\RelationManagers;
use App\Models\Income;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?string $pluralModelLabel = "Pendapatan";

    protected static ?string $navigationIcon = 'heroicon-m-currency-dollar';

    protected static ?string $navigationGroup = 'Pendapatan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(3)
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\TextInput::make('booking_code')
                            ->label('Kode Booking') //aslinya ID Booking
                            ->required()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $booking = \App\Models\Booking::where('code', $state)->first();
                                if ($booking) {
                                    $set('booking_code', $booking->id);
                                } else {
                                    $set('booking_code', null);
                                }
                            }),

                        Forms\Components\Hidden::make('booking_code')
                            ->required(),

                        Forms\Components\TextInput::make('id_m_income')
                            ->label('Tipe Pendapatan')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('id_m_method_payment')
                            ->label('ID Metode Pembayaran')
                            ->required()
                            ->numeric(),
                    ]),

                // Group untuk Informasi Tambahan dengan Kolom
                Forms\Components\Section::make()
                    ->columns(2) // Mengatur menjadi 2 kolom
                    ->heading('Informasi Tambahan')
                    ->schema([
                        Forms\Components\TextInput::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')
                            ->numeric(),
                        Forms\Components\TextInput::make('id_ms_income')
                            ->label('ID Sub Income')
                            ->required()
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
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->required()
                            ->image()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom yang sudah ada
                Tables\Columns\TextColumn::make('id_booking')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_m_income')
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
                Tables\Columns\TextColumn::make('id_ms_income')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('datetime')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_receipt')
                    ->label('Bukti Pembayaran')
                    ->sortable(),

                // Kolom yang disembunyikan secara default
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
                // Tambahkan filter jika perlu
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat Pendapatan'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Pendapatan')
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
            'index' => Pages\ListIncomes::route('/'),
            'create' => Pages\CreateIncome::route('/create'),
            // 'edit' => Pages\EditIncome::route('/{record}/edit'),
        ];
    }
}
