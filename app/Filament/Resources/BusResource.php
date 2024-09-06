<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Models\Bus;
use App\Models\BusImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;


class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    protected static ?string $pluralModelLabel = "BUS";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Bus';

    protected static ?string $navigationLabel = 'BUS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Bus')
                            ->maxLength(24)
                            ->required(),
                        Forms\Components\TextInput::make('license_plate')
                            ->label('Plat Nomor')
                            ->maxLength(10)
                            ->required(),
                        Forms\Components\TextInput::make('production_year')
                            ->numeric()
                            ->label('Tahun Produksi')
                            ->maxLength(11)
                            ->required(),
                        Forms\Components\TextInput::make('color')
                            ->label('Warna')
                            ->maxLength(10)
                            ->required(),
                        Forms\Components\TextInput::make('machine_number')
                            ->label('Nomor Mesin')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('chassis_number')
                            ->label('Nomor Chasis')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('capacity')
                            ->label('Kapasitas')
                            ->numeric()
                            ->maxLength(11)
                            ->required(),
                        Forms\Components\TextInput::make('baggage')
                            ->label('Bagasi')
                            ->numeric()
                            ->maxLength(11)
                            ->required(),
                        Forms\Components\Select::make('ms_buses_id')
                            ->label('Status Bus')
                            ->relationship('ms_buses', 'name')
                            ->required(),
                    ])
                    ->columns(2), // Mengatur jumlah kolom dalam card

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Repeater::make('images')
                            ->label('Gambar Bus')
                            ->relationship('images') // Relasi ke BusImage
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Bus Image')
                                    ->disk('public') // Tentukan disk penyimpanan
                                    ->directory('bus_images') // Direktori penyimpanan gambar
                                    ->image()
                                    ->visibility('public')
                                    ->maxSize(2048) // Maksimal ukuran gambar dalam KB
                                    ->required(),
                            ])
                            ->minItems(1)
                            ->maxItems(4), // Maksimal 4 gambar per bus
                    ])
                    ->columnSpanFull(), // Mengatur card agar se layar
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Bus'),
                Tables\Columns\ImageColumn::make('images.image')
                    ->label('Gambar Bus')
                    ->getStateUsing(fn(Model $record) => optional($record->images->first())->image) // Ambil gambar pertama
                    ->size(50), // Ukuran gambar thumbnail
                Tables\Columns\TextColumn::make('license_plate')
                    ->label('Plat Nomor'),
                Tables\Columns\TextColumn::make('production_year')
                    ->label('Tahun Produksi'),
                Tables\Columns\TextColumn::make('color')
                    ->label('Warna'),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Kapasitas'),
                Tables\Columns\TextColumn::make('ms_buses.name')
                    ->label('Status Bus'),
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
                Tables\Filters\SelectFilter::make('ms_buses_id')
                    ->label('Status Bus')
                    ->relationship('ms_buses', 'name'),
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
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->delete(); // Menggunakan soft delete
                            }
                        }),
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
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }
}
