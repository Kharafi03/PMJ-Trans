<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusKirResource\Pages;
use App\Models\BusKir;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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

    protected static ?int $navigationSort = 14;

    protected static ?string $slug = 'kir-bus';

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
                            ->label('Pelaksana')
                            ->relationship('users', 'name')
                            ->required(),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->columnSpan(2)
                            ->maxLength(255),

                        DatePicker::make('date_test')
                            ->label('Tanggal Uji KIR')
                            ->required(),

                        DatePicker::make('expiration')
                            ->label('Kadaluarsa KIR')
                            ->required(),

                        TextInput::make('nominal')
                            ->label('Biaya')
                            ->numeric()
                            ->required()
                            ->prefix('Rp. '),
                    ])
                    ->columns(2),

                Card::make()
                    ->heading('Unggah Gambar KIR')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Gambar KIR')
                            ->disk('public')
                            ->directory('kir')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->required()
                            ->helperText('Unggah gambar dalam format JPG atau PNG, maksimal ukuran 2MB.')
                            ->image(),
                    ])
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('buses.name')
                    ->label('Bus')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('users.name')
                    ->label('User')
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('description')
                //     ->label('Deskripsi')
                //     ->searchable(),
                TextColumn::make('date_test')
                    ->label('Tanggal Uji KIR')
                    ->date()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('expiration')
                    ->label('Kadaluarsa KIR')
                    ->date()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nominal')
                    ->label('Biaya')
                    ->prefix('Rp. ')
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
                    ->modalHeading('Lihat KIR'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit KIR')
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
            'index' => Pages\ListBusKirs::route('/'),
            'create' => Pages\CreateBusKir::route('/create'),
            // 'edit' => Pages\EditBusKir::route('/{record}/edit'),
        ];
    }
}
