<?php

namespace App\Filament\Pages;


use Filament\Forms;
use App\Models\Setting;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Actions\Action;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class SettingPage extends Page implements HasForms
{

    use HasPageShield;

    protected static string $view = 'filament.pages.setting-page';

    protected static ?string $navigationLabel = "Setting";

    protected static ?string $pluralModelLabel = "Pengaturan Sistem";

    protected static ?string $navigationIcon = 'heroicon-c-cog-8-tooth';

    protected static ?string $navigationGroup = 'Manajemen Sistem';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'setting';

    public ?array $data = [];

    public function mount(): void
    {

        $setting = Setting::find(1);
        // dd($setting);
        $this->form->fill($setting->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2) // Menggunakan dua kolom
                    ->schema([
                        Forms\Components\Section::make('Deskripsi dan Konten')
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->required()
                                    ->label('Logo')
                                    ->directory('logos') // Menyimpan file di folder 'logos'
                                    ->image() // Hanya menerima file gambar
                                    ->maxSize(2 * 1024) // Maksimum ukuran file 2MB
                                    ->imagePreviewHeight('250')
                                    ->helperText('Unggah logo (maksimal ukuran file: 2MB)'),

                                Forms\Components\Textarea::make('description')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Deskripsi'),

                                Forms\Components\Textarea::make('footer')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Footer'),
                                Forms\Components\Textarea::make('about_us')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Tentang Kami'),
                            ])
                            ->columnSpan(1),
                        // Kolom Pertama: Informasi Umum
                        Forms\Components\Section::make('Informasi Umum')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Nama Perusahaan'),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Email'),
                                Forms\Components\TextInput::make('contact')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Kontak'),
                                Forms\Components\TextInput::make('open_hours')
                                    ->required()
                                    ->label('Jam Buka'),
                                Forms\Components\Textarea::make('address')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Alamat'),
                                Forms\Components\TextInput::make('sosmed_ig')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Instagram'),
                                Forms\Components\TextInput::make('sosmed_fb')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Facebook'),
                                Forms\Components\TextInput::make('sosmed_yt')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Youtube'),
                                Forms\Components\Textarea::make('maps')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Link Google Maps'),
                            ])
                            ->columns(2)
                            ->columnSpan(2),


                    ])
                    ->columns(3),
            ])
            ->statePath('data');
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $setting = Setting::find(1);
        $setting->update($data);

        redirect()->to('admin/setting');

        Notification::make()
            ->title('Setting Berhasil di simpan')
            ->success()
            ->send();
    }
}
