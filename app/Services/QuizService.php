<?php

namespace App\Services;

use App\Models\quiz\Quiz;
use App\Models\quiz\QuizResult;
use App\Models\quiz\Leaderboard;
use App\Models\quiz\UserAchievement;
use App\Models\quiz\Achievements;
use Illuminate\Support\Facades\DB;

class QuizService
{
    public function calculateResults($quiz, $userAnswers, $timeTaken)
    {
        $correctAnswers = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            if (
                isset($userAnswers[$question->id]) &&
                $userAnswers[$question->id] === $question->correct_answer
            ) {
                $correctAnswers++;
            }
        }

        $percentage = ($correctAnswers / $totalQuestions) * 100;
        $score = $correctAnswers * 10; // 10 points per correct answer

        return [
            'correct_answers' => $correctAnswers,
            'total_questions' => $totalQuestions,
            'percentage' => round($percentage, 2),
            'score' => $score,
            'time_taken' => $timeTaken
        ];
    }

    public function processQuizCompletion($userId, $quizId, $results)
    {
        return DB::transaction(function () use ($userId, $quizId, $results) {
            // Simpan hasil quiz
            $quizResult = QuizResult::create([
                'user_id' => $userId,
                'quiz_id' => $quizId,
                'score' => $results['score'],
                'correct_answers' => $results['correct_answers'],
                'total_questions' => $results['total_questions'],
                'time_taken' => $results['time_taken'],
                'percentage' => $results['percentage'],
                'answers' => json_encode($results['answers'] ?? [])
            ]);

            // Update leaderboard
            $this->updateLeaderboard($userId, $results['score'], $results['correct_answers']);

            // Update achievements
            $this->updateAchievements($userId, $quizResult);

            // Update participant count
            Quiz::where('id', $quizId)->increment('participant_count');

            return $quizResult;
        });
    }

    private function updateLeaderboard($userId, $score, $correctAnswers)
    {
        $leaderboard = Leaderboard::firstOrCreate(
            ['user_id' => $userId],
            [
                'total_score' => 0,
                'quizzes_completed' => 0,
                'correct_answers' => 0
            ]
        );

        $leaderboard->total_score += $score;
        $leaderboard->quizzes_completed += 1;
        $leaderboard->correct_answers += $correctAnswers;
        $leaderboard->updateStats();
        $leaderboard->save();
    }

    private function updateAchievements($userId, $quizResult)
    {
        $achievements = Achievement::active()->get();

        foreach ($achievements as $achievement) {
            $progress = $this->calculateAchievementProgress($userId, $achievement, $quizResult);

            UserAchievement::updateOrCreate(
                [
                    'user_id' => $userId,
                    'achievement_id' => $achievement->id
                ],
                [
                    'progress' => $progress,
                    'is_unlocked' => $progress >= $achievement->target,
                    'unlocked_at' => $progress >= $achievement->target ? now() : null
                ]
            );
        }
    }

    private function calculateAchievementProgress($userId, $achievement, $quizResult = null)
    {
        $userAchievement = UserAchievement::where('user_id', $userId)
            ->where('achievement_id', $achievement->id)
            ->first();

        $currentProgress = $userAchievement ? $userAchievement->progress : 0;

        switch ($achievement->type) {
            case 'quiz_completed':
                return $currentProgress + 1;

            case 'correct_answers':
                return $currentProgress + ($quizResult ? $quizResult->correct_answers : 0);

            case 'perfect_score':
                return $currentProgress + ($quizResult && $quizResult->isPerfectScore() ? 1 : 0);

            case 'total_score':
                return $currentProgress + ($quizResult ? $quizResult->score : 0);

            default:
                return $currentProgress;
        }
    }

    public function getUserStats($userId)
    {
        $leaderboard = Leaderboard::where('user_id', $userId)->first();

        if (!$leaderboard) {
            return [
                'total_score' => 0,
                'quizzes_completed' => 0,
                'correct_answers' => 0,
                'level' => 'pemula',
                'rank' => null
            ];
        }

        return [
            'total_score' => $leaderboard->total_score,
            'quizzes_completed' => $leaderboard->quizzes_completed,
            'correct_answers' => $leaderboard->correct_answers,
            'level' => $leaderboard->level,
            'rank' => $leaderboard->rank
        ];
    }
}
