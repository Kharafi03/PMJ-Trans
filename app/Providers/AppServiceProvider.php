<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;


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
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();

            if ($setting != null) {
                // Bagikan setting ke semua view
                View::share('setting', $setting);
            } else {
                // Jika tidak ada data di tabel setting, lakukan setel ulang
                View::share('setting', (object) [
                    'id' => 1,
                    'name' => 'PMJ-Trans',
                    'logo' => 'logo/logo.png',
                    'address' => 'Jl. Lingkar Timur, Ngembal Rejo, Kecamatan Jati, Kabupaten Kudus, Jawa Tengah',
                    'email' => 'buspmjtrans@gmail.com',
                    'contact' => '6281225625255',
                    'bank_account' => '1234567890',
                    'open_hours' => 'Setiap hari jam 07.00 - 17.00 WIB',
                    'description' => '',
                    'link_maps' => 'https://maps.app.goo.gl/9KAz7RPE4aAp3nBg7',
                    'embed_maps' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12978.348270618128!2d110.8778704!3d-6.8190866!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70c5cdd4042793%3A0x22dfa84ed6ce52de!2sGarasi%20Bus%20PMJ%20Trans!5e1!3m2!1sid!2sid!4v1724347397670!5m2!1sid!2sid',
                    'sosmed_ig' => 'https://www.instagram.com/mahkotagroup.official/',
                    'sosmed_fb' => 'https://www.facebook.com/share/t1VWTThuBDxpPnBn/',
                    'sosmed_yt' => 'https://www.youtube.com/@buspmjtrans',
                    'footer' => 'PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan',
                    'about_us' => 'PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan.',
                ]);
            }
        } else {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->longText('logo');
                $table->longText('address');
                $table->string('email');
                $table->string('contact');
                $table->string('bank_account');
                $table->string('open_hours');
                $table->longText('description');
                $table->longText('link_maps');
                $table->longText('embed_maps');
                $table->string('sosmed_ig');
                $table->string('sosmed_fb');
                $table->string('sosmed_yt');
                $table->longText('footer');
                $table->longText('about_us');
                $table->softDeletes();
                $table->timestamps();
            });

            // Tambahkan data default setelah tabel dibuat
            $defaultSetting = [
                'name' => 'PMJ-Trans',
                'logo' => 'logo/logo.png',
                'address' => 'Jl. Lingkar Timur, Ngembal Rejo, Kecamatan Jati, Kabupaten Kudus, Jawa Tengah',
                'email' => 'buspmjtrans@gmail.com',
                'contact' => '6281225625255',
                'bank_account' => '1234567890',
                'contact' => '6281225625255',
                'bank_account' => '1234567890',
                'open_hours' => 'Setiap hari jam 07.00 - 17.00 WIB',
                'description' => '',
                'link_maps' => 'https://maps.app.goo.gl/9KAz7RPE4aAp3nBg7',
                'embed_maps' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12978.348270618128!2d110.8778704!3d-6.8190866!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70c5cdd4042793%3A0x22dfa84ed6ce52de!2sGarasi%20Bus%20PMJ%20Trans!5e1!3m2!1sid!2sid!4v1724347397670!5m2!1sid!2sid',
                'sosmed_ig' => 'https://www.instagram.com/mahkotagroup.official/',
                'sosmed_fb' => 'https://www.facebook.com/share/t1VWTThuBDxpPnBn/',
                'sosmed_yt' => 'https://www.youtube.com/@buspmjtrans',
                'footer' => 'PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan',
                'about_us' => 'PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan.',
            ];

            $newSetting = Setting::create($defaultSetting);

            // Bagikan setting ke semua view
            View::share('setting', $newSetting);
        }

        // Setel locale untuk Carbon ke bahasa Indonesia
        Carbon::setLocale('id');
    }
}
