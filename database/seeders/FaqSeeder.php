<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'question' => 'Bagaimana cara memesan bus?',
            'answer' => 'Anda bisa memesan bus dengan dua cara: Melalui Admin: Klik ikon “WhatsApp” atau menuju halaman “Kontak Kami” untuk terhubung langsung dengan kami. Melalui Website: Klik tombol "Pesan" di halaman pemesanan '
        ]);

        Faq::create([
            'question' => 'Bagaimana cara melakukan pembayaran?',
            'answer' => 'Setelah memesan, Anda bisa melakukan pembayaran dengan mengupload bukti transfer di website kami.'
        ]);

        Faq::create([
            'question' => 'Fasilitas apa saja yang ada di bus PMJ?',
            'answer' => 'Di dalam bus PMJ, Anda akan menemukan: Bantal dan selimut. USB charger untuk mengisi daya perangkat. Sistem hiburan untuk kenyamanan selama perjalanan. Pemanas air atau dispenser untuk kebutuhan minum '
        ]);

        Faq::create([
            'question' => 'Apa itu Leg Rest dan berapa banyak yang tersedia?',
            'answer' => 'Leg Rest adalah tempat untuk menyokong kaki agar lebih nyaman. Kami menyediakan 32 Leg Rest per unit bus. Jika Anda membawa 64 penumpang, kami sarankan untuk menyewa 2 unit bus agar semua penumpang bisa menggunakan Leg Rest. '
        ]);

        Faq::create([
            'question' => 'Apa yang harus dilakukan terkait tujuan perjalanan?',
            'answer' => 'Saat memesan, pastikan Anda mengisi tujuan wisata dengan lengkap. Jika ada perubahan tujuan tanpa memberi tahu kami sebelumnya, Anda akan dikenakan denda. '
        ]);
    }
}
