<?php

namespace App\Filament\Resources;

use App\Models\Mail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\MailResource\Pages;

class MailResource extends Resource
{
    protected static ?string $model = Mail::class;

    protected static ?string $pluralModelLabel = "Kontak";

    protected static ?string $navigationIcon = 'heroicon-s-envelope';

    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'kontak-kami';

    public static function getNavigationBadge(): ?string
    {
        $new = static::getModel()::whereColumn('created_at', 'updated_at')->count();
        if ($new > 0) {
            return "{$new}";
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
                Forms\Components\Card::make()
                    ->heading('Data Pesan')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->placeholder('Masukkan nama lengkap')
                            ->debounce(6000)
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(function ($set, $get) {
                                if (self::isFormComplete($get)) {
                                    $set('template_chat', self::generateTemplateChat($get));
                                }
                            }),

                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->required()
                            ->maxLength(15)
                            ->inputMode('tel')
                            ->placeholder('Masukkan nomor wa yang valid. Hanya angka yang diperbolehkan.')
                            ->reactive()
                            ->afterStateUpdated(function ($set, $get) {
                                if (!preg_match('/^\d+$/', $get('phone'))) {
                                    $set('phone', ''); // Mengosongkan input jika tidak valid
                                }
                                if (self::isFormComplete($get)) {
                                    $set('template_chat', self::generateTemplateChat($get));
                                }
                            }),

                        Forms\Components\TextInput::make('email')
                            ->label('Email (Opsional)')
                            ->nullable()
                            ->email()
                            ->maxLength(255)
                            ->placeholder('Masukkan alamat email yang valid, harus berakhiran @gmail.com.'),

                        Forms\Components\Textarea::make('message')
                            ->label('Pesan')
                            ->placeholder('Masukkan pesan')
                            ->required()
                            ->columnSpanFull()
                            ->reactive()
                            ->debounce(3000)
                            ->afterStateUpdated(function ($set, $get) {
                                if (self::isFormComplete($get)) {
                                    $set('template_chat', self::generateTemplateChat($get));
                                }
                            }),

                        Forms\Components\Textarea::make('template_chat')
                            ->label('Template Chat')
                            ->default(fn($get) => self::generateTemplateChat($get))
                            ->helperText('Template yang akan digunakan untuk menghubungi customer.')
                            ->nullable()
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function isFormComplete($get)
    {
        $name = $get('name');
        $phone = $get('phone');
        $message = $get('message');

        return !empty($name) && !empty($phone) && !empty($message);
    }

    public static function generateTemplateChat($get)
    {
        $name = $get('name') ?? 'Pelanggan';
        $phone = $get('phone') ?? '(tidak ada nomor telepon)';
        $message = $get('message') ?? '(tidak ada pesan)';

        return "Halo {$name},\nTerima kasih atas pesan Anda. Kami akan segera menghubungi Anda di nomor telepon: {$phone}.\nPesan Anda: {$message}";
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Nomor Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(20)
                    ->tooltip(function ($record) {
                        return $record->message;
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('template_chat')
                    ->label('Template Chat')
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->template_chat;
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Tanggal dihapus')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal diubah')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->color('secondary'),

                Tables\Actions\Action::make('hubungi')
                    ->label('Hubungi')
                    ->url(fn($record) => $record->phone
                        ? "https://wa.me/{$record->phone}?text=" . urlencode($record->template_chat)
                        : "mailto:{$record->email}?subject=Hubungi&body=" . urlencode($record->template_chat))
                    ->icon(fn($record) => $record->phone ? 'heroicon-o-phone' : 'heroicon-s-envelope')
                    ->openUrlInNewTab()
                    ->color('success'),

                Tables\Actions\Action::make('email')
                    ->label('Email')
                    ->url(fn($record) => "mailto:{$record->email}?subject=Hubungi&body=" . rawurlencode($record->template_chat))
                    ->icon('heroicon-s-envelope')
                    ->hidden(fn($record) => empty($record->email))
                    ->openUrlInNewTab()
                    ->color('info'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
            // Tambahkan relasi jika ada
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
