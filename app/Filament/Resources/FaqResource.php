<?php

namespace App\Filament\Resources;

use App\Models\Faq;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Tables\Columns\Markdowneditor;
use App\Filament\Resources\FaqResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationGroup = 'Manajemen Sistem';

    protected static ?int $navigationSort = 23;

    protected static ?string $pluralModelLabel = "FAQ";

    protected static ?string $navigationIcon = 'heroicon-m-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('question')
                    ->required()
                    ->rows(3)
                    ->columnSpan('full')
                    ->label('Pertanyaan'),

                Forms\Components\MarkdownEditor::make('answer')
                    ->columnSpan('full')
                    ->required()
                    ->label('Jawaban')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'strike',
                        'link',
                        'list',
                        'orderedList',
                        'bulletList',
                        // 'codeBlock',
                        'blockquote',
                        'heading'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->searchable()
                    ->tooltip(function ($record) {
                        return $record->question;
                    })
                    ->wrap(75)
                    ->limit(150)
                    ->searchable()
                    ->label('Pertanyaan')
                    ->sortable(),

                // Tables\Columns\TextColumn::make('answer')
                //     ->label('Jawaban')
                //     ->html() //  mendukung format HTML
                //     ->sortable()
                //     ->formatStateUsing(function ($record) {
                //         return nl2br(str_replace('. ', ".\n", $record->answer));
                //     })
                //     ->tooltip(function ($record) {
                //         return $record->answer;
                //     })
                //     // ->tooltip(function ($record) {
                //     //     // Mengganti titik menjadi baris baru
                //     //     return nl2br(str_replace('.', ".\n", $record->answer));
                //     // })
                //     // ->tooltip(function ($record) {
                //     //     // Pisahkan teks berdasarkan titik (.)
                //     //     $formattedAnswer = '<ul>';
                //     //     foreach (explode('.', $record->answer) as $line) {
                //     //         if (trim($line) !== '') {
                //     //             $formattedAnswer .= '<li>' . trim($line) . '</li>';
                //     //         }
                //     //     }
                //     //     $formattedAnswer .= '</ul>';
                //     //     return $formattedAnswer;
                //     // })
                //     ->limit(75)
                //     ->searchable(),

                Tables\Columns\TextColumn::make('answer')
                    ->label('Jawaban')
                    ->html()
                    ->sortable()
                    ->tooltip(function ($record) {
                        return strip_tags($record->answer);
                    })
                    ->wrap()
                    //->grow()
                    ->limit(200)
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
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            //'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
