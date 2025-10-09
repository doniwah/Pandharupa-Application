<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\bahasa\Language;
use App\Models\bahasa\LearningPath;
use App\Models\bahasa\Lesson;
use Illuminate\Support\Facades\DB;

class LearningPathSeeder extends Seeder
{
    public function run()
    {
        // Ambil language (misalnya Bahasa Madura - sesuaikan dengan ID di database)
        $language = Language::where('name', 'Bahasa Madura')->first();

        if (!$language) {
            $this->command->error('Language tidak ditemukan!');
            return;
        }

        // 1. PEMULA - Dasar-Dasar Bahasa
        $pemula = LearningPath::create([
            'language_id' => $language->id,
            'name' => 'Dasar-Dasar Bahasa',
            'level' => 'Pemula',
            'description' => 'Pelajari fondasi bahasa daerah dari awal',
            'total_lessons' => 4,
            'order' => 1
        ]);

        // Buat atau ambil lessons untuk Pemula
        $lessons = [
            ['title' => 'Pengenalan Huruf dan Suara', 'order' => 1],
            ['title' => 'Kosakata Sehari-hari', 'order' => 2],
            ['title' => 'Angka dan Waktu', 'order' => 3],
            ['title' => 'Keluarga dan Profesi', 'order' => 4]
        ];

        foreach ($lessons as $index => $lessonData) {
            $lesson = Lesson::firstOrCreate(
                [
                    'language_id' => $language->id,
                    'title' => $lessonData['title']
                ],
                [
                    'content' => 'Konten untuk hehe' . $lessonData['title'],
                    'order' => $lessonData['order']
                ]
            );

            // Attach lesson ke learning path
            DB::table('learning_path_lessons')->insert([
                'learning_path_id' => $pemula->id,
                'lesson_id' => $lesson->id,
                'order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 2. MENENGAH - Percakapan Praktis
        $menengah = LearningPath::create([
            'language_id' => $language->id,
            'name' => 'Percakapan Praktis',
            'level' => 'Menengah',
            'description' => 'Praktik percakapan dalam situasi sehari-hari',
            'total_lessons' => 4,
            'order' => 2
        ]);

        $menengahLessons = [
            ['title' => 'Berkenalan dan Sapa', 'order' => 5],
            ['title' => 'Berbelanja di Pasar', 'order' => 6],
            ['title' => 'Tanya Arah dan Transportasi', 'order' => 7],
            ['title' => 'Makan dan Minuman', 'order' => 8]
        ];

        foreach ($menengahLessons as $index => $lessonData) {
            $lesson = Lesson::firstOrCreate(
                [
                    'language_id' => $language->id,
                    'title' => $lessonData['title']
                ],
                [
                    'content' => 'Konten untuk ' . $lessonData['title'],
                    'order' => $lessonData['order']
                ]
            );

            DB::table('learning_path_lessons')->insert([
                'learning_path_id' => $menengah->id,
                'lesson_id' => $lesson->id,
                'order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 3. LANJUTAN - Budaya dan Tradisi
        $lanjutan = LearningPath::create([
            'language_id' => $language->id,
            'name' => 'Budaya dan Tradisi',
            'level' => 'Lanjutan',
            'description' => 'Pelajari aspek budaya dan tradisi lokal',
            'total_lessons' => 4,
            'order' => 3
        ]);

        $lanjutanLessons = [
            ['title' => 'Upacara Adat', 'order' => 9],
            ['title' => 'Cerita Rakyat', 'order' => 10],
            ['title' => 'Pantun dan Puisi', 'order' => 11],
            ['title' => 'Percakapan Formal', 'order' => 12]
        ];

        foreach ($lanjutanLessons as $index => $lessonData) {
            $lesson = Lesson::firstOrCreate(
                [
                    'language_id' => $language->id,
                    'title' => $lessonData['title']
                ],
                [
                    'content' => 'Konten untuk ' . $lessonData['title'],
                    'order' => $lessonData['order']
                ]
            );

            DB::table('learning_path_lessons')->insert([
                'learning_path_id' => $lanjutan->id,
                'lesson_id' => $lesson->id,
                'order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->command->info('Learning paths created successfully!');
    }
}
