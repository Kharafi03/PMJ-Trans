<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusMaintenanceResource\Pages;
use App\Filament\Resources\BusMaintenanceResource\RelationManagers;
use App\Models\BusMaintenance;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class BusMaintenanceResource extends Resource
{
    protected static ?string $model = BusMaintenance::class;

    protected static ?string $pluralModelLabel = "Perawatan";

    protected static ?string $navigationIcon = 'heroicon-s-wrench-screwdriver';

    protected static ?int $navigationSort = 7;

    protected static ?string $slug = 'perawatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Card untuk Data Utama
                Forms\Components\Card::make()
                    ->heading('Data Utama')
                    ->schema([
                        Forms\Components\Group::make()->schema([
                            Select::make('id_bus')
                                ->label('Bus')
                                ->relationship('buses', 'name')
                                ->required(),

                            Select::make('id_user')
                                ->label('Pelaksana')
                                ->relationship('users', 'name')
                                ->options(function () {
                                    return User::whereHas('roles', function ($query) {
                                        $query->where('name', 'driver')
                                        ->orWhere('name', 'admin');
                                    })->pluck('name', 'id'); // Mengambil nama dan id user
                                })
                                ->required(),

                            Select::make('id_m_maintenance')
                                ->label('Jenis Perawatan')
                                ->relationship('m_maintenances', 'name')
                                ->required(),
                            
                            Forms\Components\Textarea::make('description')
                                ->label('Deskripsi')
                                ->maxLength(255)
                                ->nullable(),
                        ])->columns(2),
                    ])
                    ->columns(1),

                // Card untuk Data Perawatan
                Forms\Components\Card::make()
                    ->heading('Data Perawatan')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Bukti Perawatan')
                            ->disk('public')
                            ->directory('maintenance_images')
                            ->image()
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->nullable(),

                        Forms\Components\Group::make()->schema([
                            Forms\Components\DateTimePicker::make('date')
                                ->label('Tanggal')
                                ->required(),

                            Forms\Components\TextInput::make('location')
                                ->label('Lokasi')
                                ->nullable(),
                        ])->columns(2),
                    ])
                    ->columns(1),

                // Card untuk Data Pembayaran
                Forms\Components\Card::make()
                    ->heading('Data Pembayaran')
                    ->schema([
                        Forms\Components\TextInput::make('nominal')
                            ->label('Biaya')
                            ->numeric()
                            ->prefix('Rp')
                            ->nullable(),

                        Forms\Components\FileUpload::make('image_receipt')
                            ->label('Unggah Bukti Pembayaran')
                            ->disk('public')
                            ->directory('maintenance_receipts')
                            ->image()
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->nullable(),

                        // Forms\Components\TextInput::make('latitude')
                        //     ->label('Latitude')
                        //     ->numeric()
                        //     ->nullable(),

                        // Forms\Components\TextInput::make('longitude')
                        //     ->label('Longitude')
                        //     ->numeric()
                        //     ->nullable(),
                    ])
                    ->columns(1),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('buses.name')
                    ->label('Bus')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('users.name')
                    ->label('Pelaksana')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('m_maintenances.name')
                    ->label('Jenis Perawatan')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\ImageColumn::make('image')
                //     ->label('Gambar Bus')
                //     ->getStateUsing(fn(Model $record) => optional($record->images)->image)
                //     ->size(50), 
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Biaya')
                    ->prefix('Rp. ')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->searchable()
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
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('id_m_maintenance')
                    ->label('Jenis Perawatan')
                    ->relationship('m_maintenances', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat Perawatan'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Perawatan')
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
            'index' => Pages\ListBusMaintenances::route('/'),
            'create' => Pages\CreateBusMaintenance::route('/create'),
            // 'edit' => Pages\EditBusMaintenance::route('/{record}/edit'),
        ];
    }
}
