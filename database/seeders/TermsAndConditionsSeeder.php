<?php

namespace Database\Seeders;

use App\Models\TermsAndConditions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsAndConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TermsAndConditions::create([
            'heading' => 'Umum',
            'description' => 'Dengan menggunakan layanan penyewaan bus di PMJ Trans, Anda setuju untuk mematuhi semua syarat dan ketentuan yang berlaku. PMJ Trans berhak memperbarui atau mengubah syarat dan ketentuan ini kapan saja tanpa pemberitahuan terlebih dahulu.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Pemesanan dan Pembayaran',
            'description' => 'Pemesanan harus dilakukan minimal 7 hari sebelum tanggal keberangkatan. Pembayaran dilakukan dalam dua tahap: DP (Down Payment) sebesar 30% dari total biaya sewa dan pelunasan 70% dilakukan maksimal 2 hari sebelum keberangkatan. Semua pembayaran dilakukan melalui transfer bank ke rekening resmi PMJ Trans yang akan diberikan saat konfirmasi pemesanan.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Pembatalan dan Pengembalian Dana',
            'description' => 'Pembatalan yang dilakukan lebih dari 3 hari sebelum keberangkatan akan dikenakan biaya administrasi sebesar 10% dari total biaya sewa. Pembatalan yang dilakukan dalam waktu kurang dari 3 hari sebelum keberangkatan tidak akan mendapatkan pengembalian dana (DP hangus). PMJ Trans berhak membatalkan perjalanan jika terdapat kondisi yang membahayakan keselamatan atau terjadi force majeure, dengan pengembalian dana penuh kepada penyewa.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Tanggung Jawab Penyewa',
            'description' => 'Penyewa bertanggung jawab penuh atas kerusakan atau kehilangan barang yang terjadi di dalam bus selama masa sewa. Dilarang membawa barang-barang yang melanggar hukum atau berbahaya selama perjalanan. Dilarang merokok, mengonsumsi alkohol, atau menggunakan narkotika di dalam bus.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Tanggung Jawab PMJ Trans',
            'description' => 'PMJ Trans bertanggung jawab untuk menyediakan bus dalam kondisi bersih, layak jalan, dan sesuai dengan kesepakatan. PMJ Trans menyediakan sopir profesional yang berpengalaman dan memiliki SIM yang sesuai. PMJ Trans tidak bertanggung jawab atas keterlambatan atau gangguan perjalanan yang disebabkan oleh faktor-faktor di luar kendali, seperti lalu lintas padat, bencana alam, kerusakan mekanis yang mendadak, atau tindakan pihak ketiga.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Pengguna Bus',
            'description' => 'Penggunaan bus hanya untuk keperluan yang telah disepakati pada saat pemesanan. Setiap perubahan rute atau tambahan waktu penggunaan harus disetujui oleh PMJ Trans dan dapat dikenakan biaya tambahan. Penyewa wajib mengikuti instruksi dari sopir selama perjalanan demi keselamatan dan kenyamanan.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Asuransi dan Keamanan',
            'description' => 'PMJ Trans menyediakan asuransi untuk penumpang selama perjalanan sesuai dengan ketentuan yang berlaku. Penyewa disarankan untuk memiliki asuransi tambahan jika diperlukan untuk perlindungan lebih lanjut.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Pembatasan Tanggung Jawab',
            'description' => 'PMJ Trans tidak bertanggung jawab atas kehilangan atau kerusakan barang pribadi penumpang selama perjalanan. Segala kerugian atau kerusakan yang diakibatkan oleh kelalaian penyewa atau penumpang sepenuhnya menjadi tanggung jawab penyewa.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Penyelesaian Sengketa',
            'description' => 'Segala sengketa yang timbul akibat penggunaan layanan penyewaan bus akan diselesaikan secara musyawarah untuk mufakat. Jika tidak tercapai kesepakatan, maka sengketa akan diselesaikan sesuai dengan hukum yang berlaku di Indonesia.'
        ]);
        TermsAndConditions::create([
            'heading' => 'Kontak',
            'description' => 'Untuk pertanyaan lebih lanjut mengenai penyewaan bus, Anda dapat menghubungi layanan pelanggan PMJ Trans melalui nomor telepon atau email yang tertera di situs resmi kami.'
        ]);        
    }
}
