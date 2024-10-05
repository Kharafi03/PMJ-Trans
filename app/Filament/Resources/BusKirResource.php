<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusKirResource\Pages;
use App\Models\BusKir;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BusKirResource extends Resource
{
    protected static ?string $model = BusKir::class;

    protected static ?string $pluralModelLabel = "KIR";

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    //protected static ?string $navigationGroup = 'Bus';

    protected static ?int $navigationSort = 14;


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Card::make()
                    ->heading('Data KIR')
                    ->schema([
                        Select::make('id_bus')
                            ->label('Bus')
                            ->relationship('buses', 'name')
                            ->required(),

                        Select::make('id_user')
                            ->label('User')
                            ->relationship('users', 'name') // Asumsikan ada relasi dengan User model
                            ->required(),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->maxLength(255),

                        DateTimePicker::make('date_test')
                            ->label('Tanggal Uji KIR')
                            ->required(),

                        DateTimePicker::make('expiration')
                            ->label('Kadaluarsa KIR')
                            ->required(),

                        TextInput::make('cost')
                            ->label('Biaya')
                            ->numeric()
                            ->prefix('Rp. '),

                        FileUpload::make('image')
                            ->label('Gambar KIR')
                            ->disk('public')
                            ->directory('kir')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']) // Format gambar yang diperbolehkan
                            ->required()
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->image(),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id_bus')
                    ->label('Bus')
                    ->sortable(),

                TextColumn::make('id_user')
                    ->label('User')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),

                TextColumn::make('date_test')
                    ->label('Tanggal Uji KIR')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('expiration')
                    ->label('Kadaluarsa KIR')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('cost')
                    ->label('Biaya')
                    ->prefix('Rp. ')
                    ->sortable(),

                TextColumn::make('deleted_at')
                    ->label('Tanggal dihapus')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Tanggal dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
                    ->modalHeading('Lihat KIR'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit KIR')
                    ->modalButton('Simpan Perubahan'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBusKirs::route('/'),
            'create' => Pages\CreateBusKir::route('/create'),
            // 'edit' => Pages\EditBusKir::route('/{record}/edit'),
        ];
    }
}
