<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TermsAndConditionsResource\Pages;
use App\Filament\Resources\TermsAndConditionsResource\RelationManagers;
use App\Models\TermsAndConditions;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TermsAndConditionsResource extends Resource
{
    protected static ?string $model = TermsAndConditions::class;

    protected static ?string $pluralModelLabel = "Syarat & Ketentuan";

    protected static ?string $navigationGroup = 'Manajemen Sistem';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'syarat-dan-ketentuan';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        TextInput::make('heading')
                            ->label('Judul')
                            ->placeholder('Masukkan Heading'),
                        Forms\Components\MarkdownEditor::make('description')
                            ->columnSpan('full')
                            ->required()
                            ->label('Deskripsi')
                            ->toolbarButtons([
                                // 'bold',
                                // 'italic',
                                // 'strike',
                                // 'link',
                                // 'list',
                                'orderedList',
                                // 'bulletList',
                                // // 'codeBlock',
                                // 'blockquote',
                                // 'heading'
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'asc')
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->sortable(),
                TextColumn::make('heading')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40)
                    ->wrap(20)
                    ->tooltip(function ($record) {
                        return $record->heading;
                    })
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Syarat dan Ketentuan')
                    ->limit(250)
                    ->wrap(75)
                    ->searchable()
                    ->tooltip(function ($record) {
                        return $record->description;
                    })
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Lihat Syarat & Ketentuan '),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Syarat & Ketentuan')
                    ->modalButton('Simpan Perubahan'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),

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
            'index' => Pages\ListTermsAndConditions::route('/'),
            'create' => Pages\CreateTermsAndConditions::route('/create'),
            //'edit' => Pages\EditTermsAndConditions::route('/{record}/edit'),
        ];
    }
}
