<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\quiz\Leaderboard;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LeaderboardSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'Siti Aminah', 'email' => 'siti@example.com', 'level' => 'master', 'score' => 9850],
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'level' => 'expert', 'score' => 9720],
            ['name' => 'Rahma Wati', 'email' => 'rahma@example.com', 'level' => 'expert', 'score' => 9640],
            ['name' => 'Ahmad Fauzi', 'email' => 'ahmad@example.com', 'level' => 'advanced', 'score' => 9580],
            ['name' => 'Nur Hayati', 'email' => 'nur@example.com', 'level' => 'advanced', 'score' => 9520],
            ['name' => 'Dedi Kurniawan', 'email' => 'dedi@example.com', 'level' => 'advanced', 'score' => 9480],
            ['name' => 'Lina Marlina', 'email' => 'lina@example.com', 'level' => 'intermediate', 'score' => 9350],
            ['name' => 'Eko Prasetyo', 'email' => 'eko@example.com', 'level' => 'intermediate', 'score' => 9290],
            ['name' => 'Maya Sari', 'email' => 'maya@example.com', 'level' => 'intermediate', 'score' => 9150],
            ['name' => 'Rizki Pratama', 'email' => 'rizki@example.com', 'level' => 'pemula', 'score' => 8900],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                ]
            );

            Leaderboard::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'total_score' => $userData['score'],
                    'quizzes_completed' => rand(5, 20),
                    'correct_answers' => rand(50, 300),
                    'level' => $userData['level']
                ]
            );
        }
    }
}
