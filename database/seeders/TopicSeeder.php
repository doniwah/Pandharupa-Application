<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        $topics = [
            [
                'user_id' => $users->random()->id,
                'category_id' => Category::where('slug', 'bahasa-daerah')->first()->id,
                'title' => 'Tips Belajar Bahasa Madura untuk Pemula',
                'content' => 'Selamat siang semua! Saya ingin berbagi beberapa tips belajar bahasa Madura yang telah saya praktikkan...',
                'views' => 156,
            ],
            [
                'user_id' => $users->random()->id,
                'category_id' => Category::where('slug', 'kuliner')->first()->id,
                'title' => 'Resep Autentik Rujak Cingur Tradisional',
                'content' => 'Halo teman-teman! Hari ini saya akan berbagi resep rujak cingur yang turun temurun dari nenek saya...',
                'views' => 89,
            ],
            [
                'user_id' => $users->random()->id,
                'category_id' => Category::where('slug', 'seni-budaya')->first()->id,
                'title' => 'Dokumentasi Tari Jejer di Festival Budaya 2024',
                'content' => 'Kemarin saya berkesempatan menghadiri Festival Budaya 2024 dan menyaksikan pertunjukan Tari Jejer yang memukau...',
                'views' => 234,
            ],
            [
                'user_id' => $users->random()->id,
                'category_id' => Category::where('slug', 'sejarah')->first()->id,
                'title' => 'Mencari Informasi Sejarah Kerajaan Pendalungan',
                'content' => 'Saya sedang meneliti sejarah Kerajaan Pendalungan untuk tugas akhir. Adakah yang bisa merekomendasikan sumber referensi?',
                'views' => 67,
            ],
            [
                'user_id' => $users->random()->id,
                'category_id' => Category::where('slug', 'event')->first()->id,
                'title' => 'Workshop Batik Motif Pendalungan - Pendaftaran Terbuka',
                'content' => 'Kabar gembira! Workshop Batik Motif Pendalungan akan diadakan bulan depan. Yuk daftar sebelum kuota penuh!',
                'views' => 312,
            ],
            [
                'user_id' => $users->random()->id,
                'category_id' => Category::where('slug', 'umum')->first()->id,
                'title' => 'Kolaborasi Penelitian Budaya Lokal',
                'content' => 'Saya dari universitas setempat mencari mitra untuk penelitian budaya lokal. Mari berkolaborasi!',
                'views' => 95,
            ],
        ];

        foreach ($topics as $topic) {
            Topic::create($topic);
        }
    }
}