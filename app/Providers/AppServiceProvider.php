<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

use function Laravel\Prompts\alert;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cek apakah ada data di tabel setting
        $setting = Setting::first();
        // dd($setting);

        if ($setting != null) {
            // Bagikan setting ke semua view
            View::share('setting', $setting);
        } else {
            // Jika tidak ada data di tabel setting, lakukan setel ulang
            View::share('setting', (object) [
                'id' => 1,
                'name' => 'PMJ-Trans',
                'logo' => 'logo.png',
                'address' => 'Jl. Lingkar Timur, Ngembal Rejo, Kecamatan Jati, Kabupaten Kudus, Jawa Tengah',
                'email' => 'buspmjtrans@gmail.com',
                'contact' => '0812-2562-5255',
                'open_hours' => 'Setiap hari jam 07.00 - 17.00 WIB',
                'description' => '',
                'maps' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12978.348270618128!2d110.8778704!3d-6.8190866!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70c5cdd4042793%3A0x22dfa84ed6ce52de!2sGarasi%20Bus%20PMJ%20Trans!5e1!3m2!1sid!2sid!4v1724347397670!5m2!1sid!2sid',
                'sosmed_ig' => 'https://www.instagram.com/mahkotagroup.official/',
                'sosmed_fb' => 'https://www.facebook.com/share/t1VWTThuBDxpPnBn/',
                'sosmed_yt' => 'https://www.youtube.com/@buspmjtrans',
                'footer' => 'PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan',
                'about_us' => 'PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan.',
            ]);

            session()->flash('message', 'Pengaturan situs tidak ditemukan. Menggunakan nilai default.');
            session()->flash('alert-type', 'error');
            
        }

        // Setel locale untuk Carbon ke bahasa Indonesia
        Carbon::setLocale('id');
    }
}
