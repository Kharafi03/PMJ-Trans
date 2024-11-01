<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutcomeResource\Pages;
use App\Models\Outcome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;

class OutcomeResource extends Resource
{
    protected static ?string $model = Outcome::class;

    protected static ?string $pluralModelLabel = "Pengeluaran";

    protected static ?string $navigationIcon = 'heroicon-c-arrow-trending-down';

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'pengeluaran-booking';

    public static function getNavigationBadge(): ?string
    {
        $newdraf = static::getModel()::where('check', false)->count();
        if ($newdraf > 0) {
            return "{$newdraf}";
        }
        return "";
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Group untuk Data Utama
                Forms\Components\Section::make()
                    ->columns(2) // 2 kolom untuk data utama
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\Select::make('id_m_outcome')
                            ->label('Tipe Pengeluaran')
                            ->required()
                            ->relationship('m_outcome', 'name'),

                        Forms\Components\TextInput::make('code_outcome')
                            ->label('Kode Sumber Pengeluaran')
                            ->required(),

                        Forms\Components\Select::make('id_m_method_payment')
                            ->label('Metode Pembayaran')
                            ->required()
                            ->relationship('m_method_payment', 'name'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')
                            ->prefix('Rp.')
                            ->numeric(),

                        Forms\Components\DateTimePicker::make('datetime')
                            ->label('Tanggal dan Waktu'),

                        Forms\Components\Toggle::make('check')
                            ->label('Selesai')
                            ->required(),
                    ]),

                // Group untuk Upload Bukti Pembayaran
                Forms\Components\Section::make()
                    ->heading('Unggah Bukti Pembayaran')
                    ->schema([
                        Forms\Components\FileUpload::make('image_receipt')
                            ->label('Bukti Pembayaran')
                            ->required()
                            ->disk('public')
                            ->directory('outcomes_image_receipt')
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
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('m_outcome.name')
                    ->label('Tipe')
                    ->sortable()
                    ->colors([
                        'danger' => 'Refund',
                        'success' => 'Operasional',
                    ])
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),
                Tables\Columns\IconColumn::make('check')
                    ->label('Selesai')
                    ->boolean()
                    ->searchable(),
                Tables\Columns\TextColumn::make('code_outcome')
                    ->label('Code Pengeluaran')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->limit(25)
                    ->tooltip(function ($record) {
                        return $record->description;
                    }),
                BadgeColumn::make('m_method_payment.name')
                    ->label('Metode')
                    ->sortable()
                    ->colors([
                        'info' => 'Transfer Bank',
                        'warning' => 'Transfer E-Wallet',
                        'success' => 'Tunai',
                    ])
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),

                Tables\Columns\TextColumn::make('nominal')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('datetime')
                    ->label('Tanggal Pengeluaran')
                    ->dateTime()
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
                Tables\Filters\SelectFilter::make('id_m_outcome')
                    ->label('Tipe')
                    ->relationship('m_outcome', 'name'),
                Tables\Filters\SelectFilter::make('id_m_method_payment')
                    ->label('Status Pemesanan')
                    ->relationship('m_method_payment', 'name'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ForceDeleteAction::make(),
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
            'index' => Pages\ListOutcomes::route('/'),
            'create' => Pages\CreateOutcome::route('/create'),
            // 'edit' => Pages\EditOutcome::route('/{record}/edit'),
        ];
    }
}
