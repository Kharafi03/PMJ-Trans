<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MailResource\Pages;
use App\Filament\Resources\MailResource\RelationManagers;
use App\Models\Mail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MailResource extends Resource
{
    protected static ?string $model = Mail::class;

    protected static ?string $pluralModelLabel = "Pesan";

    protected static ?string $navigationIcon = 'heroicon-s-envelope';

    protected static ?string $navigationGroup = 'Manajemen Sistem';

    // protected static ?int $navigationSort = 20;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->heading('Data Pesan')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no/email')
                            ->label('Nomor atau Email')
                            ->placeholder('Masukkan Nomor Telepon atau Email')
                            ->required()
                            ->maxLength(255)
                            ->inputMode('email') // Mengatur keyboard mobile agar sesuai dengan input email
                            ->rules(['required', 'regex:/^(\+?\d{1,3}[- ]?)?\d{10,13}$|^.+@.+\..+$/']) // Aturan validasi sebagai array
                            ->helperText('Masukkan nomor telepon atau alamat email yang valid.'),


                        Forms\Components\Textarea::make('message')
                            ->label('Pesan')
                            ->required()
                            ->columnSpanFull(),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no/email')
                    ->label('Nomor atau Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->searchable(),
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
                    ->modalHeading('Lihat Pesan'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Pesan')
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
            'index' => Pages\ListMails::route('/'),
            'create' => Pages\CreateMail::route('/create'),
            //'edit' => Pages\EditMail::route('/{record}/edit'),
        ];
    }
}
