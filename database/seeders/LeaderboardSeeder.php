<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\quiz\Leaderboard;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaderboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        Leaderboard::truncate();

        $users = User::all();

        foreach ($users as $user) {
            $totalScore = rand(100, 10000);
            $quizzesCompleted = rand(1, 50);
            $correctAnswers = rand(10, 200);

            // PERBAIKAN: Gunakan bahasa Inggris untuk level
            $level = $this->calculateLevel($totalScore);

            Leaderboard::create([
                'user_id' => $user->id,
                'total_score' => $totalScore,
                'quizzes_completed' => $quizzesCompleted,
                'correct_answers' => $correctAnswers,
                'level' => $level
            ]);
        }

        $this->command->info('Leaderboard seeded successfully!');
    }

    private function calculateLevel($score)
    {
        if ($score >= 5000) return 'master';
        if ($score >= 3000) return 'expert';
        if ($score >= 1500) return 'advanced';
        if ($score >= 500) return 'intermediate';
        return 'beginner';
    }
}
