<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\bahasa\Language;
use App\Models\bahasa\Lesson;
use App\Models\bahasa\AudioPhrase;
use App\Models\bahasa\Vocabulary;
use App\Models\bahasa\LearningPath;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BahasaSeeder::class,
            LearningPathSeeder::class,
            LessonSeeder::class,
        ]);
    }
}
