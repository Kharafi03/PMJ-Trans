<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BusMaintenance;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BusMaintenanceResource\Pages;
use App\Models\Outcome;

class BusMaintenanceResource extends Resource
{
    protected static ?string $model = BusMaintenance::class;

    protected static ?string $pluralModelLabel = "Perawatan";

    protected static ?string $navigationIcon = 'heroicon-s-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Manajemen Bus';

    protected static ?int $navigationSort = -1;

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
                            Forms\Components\TextInput::make('maintenance_code')
                                ->default(fn() => 'MTC-' . strtoupper(substr(str_shuffle(bin2hex(random_bytes(4)) . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8)))
                                ->required()
                                ->readOnly()
                                ->label('Kode Perawatan'),

                            Select::make('id_bus')
                                ->label('Bus')
                                ->relationship('buses', 'name')
                                ->required(),

                            Select::make('id_user')
                                ->label('Pelaksana')
                                ->relationship('users', 'name')
                                ->options(function () {
                                    return User::whereHas('roles', function ($query) {
                                        $query->where('name', '!=', 'panel_user');
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
                                ->rows(1)
                                ->columnSpan(2)
                                ->nullable(),
                        ])->columns(3),
                    ])
                    ->columns(1),
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
                Forms\Components\Card::make()
                    ->heading('Data Pembayaran')
                    ->schema([
                        Forms\Components\TextInput::make('nominal')
                            ->label('Biaya')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),

                        Select::make('id_m_method_payment')
                            ->label('Metode Pembayaran')
                            ->relationship('m_method_payment', 'name')
                            ->required(),

                        Forms\Components\FileUpload::make('image_receipt')
                            ->label('Unggah Bukti Pembayaran')
                            ->disk('public')
                            ->directory('maintenance_receipts')
                            ->image()
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->visibility('public')
                            // ->afterStateUpdated(function (Get $get, Set $set) {
                            //     self::addOutcome($get, $set);
                            // })
                            ->maxSize(2048),

                        // Forms\Components\TextInput::make('latitude')
                        //     ->label('Latitude')
                        //     ->numeric()
                        //     ->nullable(),

                        // Forms\Components\TextInput::make('longitude')
                        //     ->label('Longitude')
                        //     ->numeric()
                        //     ->nullable(),
                    ])
                    ->columns(2),

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
                Tables\Columns\TextColumn::make('maintenance_code')
                    ->label('Kode Perawatan')
                    ->searchable()
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('id_m_maintenance')
                    ->label('Jenis Perawatan')
                    ->relationship('m_maintenances', 'name'),
                Tables\Filters\TrashedFilter::make(),
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
                    ->action(function ($record) {
                        //$maintenance_code = $record->maintenance_code
                        Outcome::where('outcome_code', $record->maintenance_code)->delete();
                        BusMaintenance::where('id', $record->id)->delete();
                    })
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
            'edit' => Pages\EditBusMaintenance::route('/{record}/edit'),
        ];
    }

    // public static function addOutcome(Get $get, Set $set)
    // {
    //     $nameBus = Bus::where('id', $get('id_bus'))->value('name');
    //     $nameUser = User::where('id', $get('id_user'))->value('name');
    //     $nameMaintenance = MMaintenance::where('id', $get('id_m_maintenance'))->value('name');

    //     Outcome::updateOrCreate(
    //         ['code_outcome' => $get('maintenance_code')],
    //         [
    //             'id_m_outcome' => 3,
    //             'check' => 1,
    //             'code_outcome' => $get('maintenance_code'),
    //             'image_receipt' => $get('image_receipt'),
    //             'nominal' => $get('nominal'),
    //             'id_m_method_payment' => $get('id_m_method_payment'),
    //             'description' => $nameMaintenance . ' Bus ' . $nameBus . ' oleh ' . $nameUser . ' Dengan deskripsi : ' . $get('description'),
    //             'datetime' => now(),
    //         ]
    //     );
    // }
}
