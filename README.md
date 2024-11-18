# PMJ-Trans

PMJ-Trans adalah aplikasi manajemen perjalanan untuk perusahaan bus, dibangun menggunakan Laravel. Aplikasi ini menawarkan manajemen armada, pemesanan, pelacakan perjalanan, dan pengelolaan keuangan yang mudah.

## Fitur

- Manajemen Armada: Atur data dan status kendaraan.
- Sistem Pemesanan: Kelola pemesanan dan pembayaran.
- Pelacakan Perjalanan: Pantau perjalanan dengan status real-time.
- Manajemen Pembayaran & Pengeluaran: Catat penerimaan dan pengeluaran perjalanan.
- Role-Based Access Control: Akses berbeda untuk admin, driver, dan user.

## Persyaratan
- PHP 8.2^
- Composer
- Node.js
- Database (MySQL)
- Laravel 11
- Filament v.3

## Instalasi

1. Clone repositori ini ke dalam komputer lokal Anda:

bash
git clone https://github.com/kharafi03/pmj-trans.git

bash
cd PMJ-Trans


2. Instal dependensi menggunakan Composer:

bash
composer install


3. Copy .env.example ke .env dan konfigurasi sesuai kebutuhan:

bash
cp .env.example .env


4. Generate application key:
bash
php artisan key:generate


5. Atur konfigurasi database di file .env sesuai dengan database yang akan digunakan:
bash
php artisan key:generateDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database


6. Jalankan migrasi dan seeder untuk membuat tabel dan data awal:
bash
php artisan migrate:fresh --seed

7. Jalankan shield untuk peran pengguna
bash
php artisan shield:install


8. Jalankan penyimpanan link
bash
php artisan storage:link

9. Build frontend assets
bash
npm install

bash
npm run dev

10. php artisan serve
bash
php artisan serve


## Struktur Proyek
- app/Models - Model untuk data utama seperti Bus, Booking, Trip, dll.
- app/Filament/Resources - Digunakan untuk menyimpan resource files yang mengelola data, berisi CRUD admin dan super admin di Filament
- app/Http/Controllers - Berisi controller seperti BookingController, TripController, DashboardTripController.
- database/migrations - File migrasi untuk membuat tabel.
- database/seeders - Seeder untuk data awal, termasuk pengguna dan peran.
- resources/views - Berisi file view untuk frontend dan backend.
- routes/web.php - Definisi rute untuk aplikasi web.

## Konfigurasi Pengguna dan Peran
Aplikasi ini menggunakan Filament Shield untuk mengatur akses pengguna berdasarkan peran. Secara default, role super_admin dan panel_user dibuat saat menjalankan seeder. Peran ini memiliki akses yang berbeda sesuai dengan fungsinya:
- super_admin: Akses penuh ke seluruh fitur terutama dashboard admin.
- panel_user: Hanya dapat mengakses halaman depan.
- Driver: Hanya dapat mengakses ke dashboard Driver

Setelah dijalankan, mohon segera tambahkan roles dengan nama Driver, lalu plotkan akun driver dengan roles Driver