<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusMaintenanceResource\Pages;
use App\Filament\Resources\BusMaintenanceResource\RelationManagers;
use App\Models\BusMaintenance;
use Filament\Forms;
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

    protected static ?string $navigationIcon = 'heroicon-m-calendar-days';

    protected static ?string $navigationGroup = 'Bus';

    protected static ?string $navigationLabel = 'Perawatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\Select::make('id_bus')
                        ->label('Bus')
                        ->relationship('buses', 'name')
                        ->required(),

                    Forms\Components\Select::make('id_user')
                        ->label('User')
                        ->relationship('users', 'name') // Asumsikan ada relasi dengan User model
                        ->required(),

                    Forms\Components\Select::make('id_m_maintenance')
                        ->label('Jenis Perawatan')
                        ->relationship('m_maintenances', 'name')
                        ->required(),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->maxLength(255)
                        ->nullable(),
                ])
                    ->extraAttributes(['class' => 'bg-white shadow-lg rounded-lg p-4'])
                    ->columns(1),

                Forms\Components\Card::make([
                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar Perawatan')
                        ->disk('public') // Tentukan disk penyimpanan
                        ->directory('maintenance_images') // Direktori penyimpanan gambar
                        ->image()
                        ->visibility('public')
                        ->maxSize(2048) // Maksimal ukuran gambar dalam KB
                        ->nullable(),

                    Forms\Components\DateTimePicker::make('date')
                        ->label('Tanggal')
                        ->required(),

                    Forms\Components\TextInput::make('location')
                        ->label('Lokasi')
                        ->nullable(),

                    Forms\Components\TextInput::make('cost')
                        ->label('Biaya')
                        ->numeric()
                        ->nullable(),
                ])
                    ->extraAttributes(['class' => 'bg-white shadow-lg rounded-lg p-4'])
                    ->columns(1),

                Forms\Components\Card::make([
                    Forms\Components\FileUpload::make('image_receipt')
                        ->label('Gambar Bukti Pembayaran')
                        ->disk('public')
                        ->directory('maintenance_receipts')
                        ->image()
                        ->visibility('public')
                        ->maxSize(2048)
                        ->nullable(),

                    Forms\Components\TextInput::make('latitude')
                        ->label('Latitude')
                        ->numeric()
                        ->nullable(),

                    Forms\Components\TextInput::make('longitude')
                        ->label('Longitude')
                        ->numeric()
                        ->nullable(),
                ])
                    ->extraAttributes(['class' => 'bg-white shadow-lg rounded-lg p-4'])
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
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('m_maintenances.name')
                    ->label('Jenis Perawatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->searchable()
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus') // Ganti label jika diperlukan
                    ->action(function (Model $record) {
                        $record->delete(); // Menggunakan soft delete
                    }),
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
}
