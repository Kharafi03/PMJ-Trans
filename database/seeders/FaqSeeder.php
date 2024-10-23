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
            'question' => 'Halo, Apa Kabar?',
            'answer' => 'Hai, Saya Baiik Baik saja, kamu bagaimana hari ini? apakah berjalan dengan lancar? '
        ]);
    }
}
