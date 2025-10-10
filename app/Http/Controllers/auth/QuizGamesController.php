<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\quiz\Quiz;
use App\Models\quiz\Question;
use App\Models\quiz\QuizResult;
use App\Models\quiz\Achievements;
use App\Models\quiz\Leaderboard;
use App\Models\User;
use App\Services\QuizService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class QuizGamesController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function index()
    {
        $userId = Auth::id() ?? 1;

        // PERBAIKAN: Hitung statistik dengan validasi data
        $totalParticipants = QuizResult::distinct('user_id')->count('user_id');
        $totalQuestions = Question::count();

        // PERBAIKAN: Hitung rata-rata waktu dengan filter valid data
        $averageTime = QuizResult::whereNotNull('time_taken')
            ->where('time_taken', '>', 0)
            ->avg('time_taken');
        $completionRate = $averageTime ? round($averageTime / 60, 1) : 0;

        // Hitung master users
        $masterUsers = QuizResult::select('user_id')
            ->selectRaw('AVG(percentage) as avg_score')
            ->groupBy('user_id')
            ->having('avg_score', '>=', 80)
            ->count();

        // PERBAIKAN: Load quizzes dengan participant count yang akurat
        $quizzes = Quiz::withCount('questions')
            ->get()
            ->map(function ($quiz) {
                // Hitung participant count dari quiz_results
                $participantCount = QuizResult::where('quiz_id', $quiz->id)
                    ->distinct('user_id')
                    ->count('user_id');

                $quiz->participant_count = $participantCount;
                return $quiz;
            });

        // Query leaderboard
        $leaderboard = User::whereHas('quizResults')
            ->with(['quizStats' => function ($query) {
                $query->select('user_id', 'total_score', 'level');
            }])
            ->join('user_quiz_stats', 'users.id', '=', 'user_quiz_stats.user_id')
            ->orderBy('user_quiz_stats.total_score', 'desc')
            ->select(
                'users.id',
                'users.name',
                'user_quiz_stats.total_score',
                'user_quiz_stats.level'
            )
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return (object) [
                    'user' => (object) [
                        'id' => $user->id,
                        'name' => $user->name
                    ],
                    'total_score' => $user->total_score,
                    'level' => $user->level
                ];
            });

        $achievements = $this->calculateAchievements($userId);

        return view('pages/quiz_games.quiz', compact(
            'totalParticipants',
            'totalQuestions',
            'completionRate',
            'masterUsers',
            'quizzes',
            'leaderboard',
            'achievements'
        ));
    }

    public function showQuiz($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        return view('pages.quiz_games.quiz_detail', compact('quiz'));
    }

    public function submitQuiz(Request $request, $quizId)
    {
        Log::info('=== QUIZ SUBMIT START ===');
        Log::info('Request data:', $request->all());

        // PERBAIKAN: Validasi input
        $validated = $request->validate([
            'time_taken' => 'required|integer|min:0',
            'correct_answers' => 'required|integer|min:0',
            'score' => 'required|integer|min:0',
            'percentage' => 'required|numeric|min:0|max:100',
            'answers' => 'nullable|array'
        ]);

        DB::beginTransaction();
        try {
            $userId = Auth::id() ?? 1;
            $quiz = Quiz::findOrFail($quizId);

            Log::info('Quiz found', [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'current_participants' => $quiz->participant_count
            ]);

            // 1. SIMPAN QUIZ RESULT DULU
            $quizResultData = [
                'user_id' => $userId,
                'quiz_id' => $quizId,
                'time_taken' => $validated['time_taken'],
                'correct_answers' => $validated['correct_answers'],
                'total_questions' => $quiz->questions()->count(),
                'score' => $validated['score'],
                'percentage' => $validated['percentage'],
                'completed_at' => now()
            ];

            // PERBAIKAN: Cek apakah column answers ada
            if (Schema::hasColumn('quiz_results', 'answers') && isset($validated['answers'])) {
                $quizResultData['answers'] = json_encode($validated['answers']);
            }

            $quizResult = QuizResult::create($quizResultData);
            Log::info('Quiz result saved', ['id' => $quizResult->id]);

            // 2. UPDATE USER QUIZ STATS
            $this->updateUserQuizStats($userId, $quizId, $validated);

            // 3. UPDATE LEADERBOARD
            $this->updateLeaderboard($userId);

            // 4. CHECK ACHIEVEMENTS
            $this->checkAchievements($userId);

            // 5. UPDATE PARTICIPANT COUNT - Hitung ulang dari database
            $actualParticipantCount = QuizResult::where('quiz_id', $quizId)
                ->distinct('user_id')
                ->count('user_id');

            $quiz->participant_count = $actualParticipantCount;
            $quiz->save();

            Log::info('Participant count updated', [
                'new_count' => $actualParticipantCount
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Quiz berhasil disimpan!',
                'data' => [
                    'participant_count' => $actualParticipantCount,
                    'time_taken' => $validated['time_taken'],
                    'score' => $validated['score'],
                    'percentage' => $validated['percentage']
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation error:', ['errors' => $e->errors()]);

            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('QUIZ SUBMIT ERROR:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function updateUserQuizStats($userId, $quizId, $data)
    {
        try {
            $userStats = \App\Models\UserQuizStats::firstOrNew(
                ['user_id' => $userId],
                [
                    'total_quizzes_taken' => 0,
                    'total_score' => 0,
                    'average_score' => 0,
                    'level' => 'beginner'
                ]
            );

            $userStats->total_quizzes_taken += 1;
            $userStats->total_score += $data['score'];
            $userStats->average_score = $userStats->total_quizzes_taken > 0
                ? round($userStats->total_score / $userStats->total_quizzes_taken, 2)
                : 0;
            $userStats->last_quiz_at = now();

            // Update level
            if (method_exists($userStats, 'updateLevel')) {
                $userStats->updateLevel();
            } else {
                $userStats->level = $this->calculateLevel($userStats->total_score);
            }

            $userStats->save();

            Log::info('User stats updated', [
                'user_id' => $userId,
                'total_quizzes' => $userStats->total_quizzes_taken,
                'total_score' => $userStats->total_score
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating user quiz stats: ' . $e->getMessage());
            throw $e; // Re-throw untuk rollback transaction
        }
    }

    private function updateLeaderboard($userId)
    {
        $userResults = QuizResult::where('user_id', $userId)
            ->whereNotNull('completed_at')
            ->get();

        $totalScore = $userResults->sum('score');
        $quizzesCompleted = $userResults->count();
        $correctAnswers = $userResults->sum('correct_answers');

        $level = $this->calculateLevel($totalScore);

        Leaderboard::updateOrCreate(
            ['user_id' => $userId],
            [
                'total_score' => $totalScore,
                'quizzes_completed' => $quizzesCompleted,
                'correct_answers' => $correctAnswers,
                'level' => $level
            ]
        );
    }

    private function checkAchievements($userId)
    {
        $achievements = Achievements::where('is_active', true)->get();

        if ($achievements->isEmpty()) {
            return;
        }

        $user = User::find($userId);

        foreach ($achievements as $achievement) {
            $progress = $this->calculateAchievementProgress($user, $achievement);

            $existingAchievement = DB::table('user_achievements')
                ->where('user_id', $user->id)
                ->where('achievement_id', $achievement->id)
                ->first();

            if ($progress >= $achievement->target) {
                DB::table('user_achievements')->updateOrInsert(
                    [
                        'user_id' => $user->id,
                        'achievement_id' => $achievement->id
                    ],
                    [
                        'progress' => $progress,
                        'is_unlocked' => true,
                        'unlocked_at' => $existingAchievement && $existingAchievement->is_unlocked
                            ? $existingAchievement->unlocked_at
                            : now(),
                        'updated_at' => now()
                    ]
                );
            } else {
                DB::table('user_achievements')->updateOrInsert(
                    [
                        'user_id' => $user->id,
                        'achievement_id' => $achievement->id
                    ],
                    [
                        'progress' => $progress,
                        'updated_at' => now()
                    ]
                );
            }
        }
    }

    private function calculateAchievements($userId)
    {
        $userStats = \App\Models\UserQuizStats::where('user_id', $userId)->first();

        if (!$userStats) {
            return $this->getDefaultAchievements();
        }

        $quizCountProgress = min(100, ($userStats->total_quizzes_taken / 5) * 100);
        $scoreProgress = min(100, $userStats->average_score);

        return [
            [
                'name' => 'Pemula',
                'description' => 'Selesaikan quiz pertama Anda',
                'icon' => 'bi bi-star',
                'percentage' => $userStats->total_quizzes_taken > 0 ? 100 : 0
            ],
            [
                'name' => 'Quiz Enthusiast',
                'description' => 'Selesaikan 5 quiz',
                'icon' => 'bi bi-trophy',
                'percentage' => round($quizCountProgress)
            ],
            [
                'name' => 'Master Quiz',
                'description' => 'Dapatkan score 100%',
                'icon' => 'bi bi-award',
                'percentage' => round($scoreProgress)
            ]
        ];
    }

    private function getDefaultAchievements()
    {
        return [
            [
                'name' => 'Pemula',
                'description' => 'Selesaikan quiz pertama Anda',
                'icon' => 'bi bi-star',
                'percentage' => 0
            ],
            [
                'name' => 'Quiz Enthusiast',
                'description' => 'Selesaikan 5 quiz',
                'icon' => 'bi bi-trophy',
                'percentage' => 0
            ],
            [
                'name' => 'Master Quiz',
                'description' => 'Dapatkan score 100%',
                'icon' => 'bi bi-award',
                'percentage' => 0
            ]
        ];
    }

    private function calculateAchievementProgress($user, $achievement)
    {
        // Implementation depends on achievement type
        return 0;
    }

    public function getStats()
    {
        $totalParticipants = QuizResult::distinct('user_id')->count('user_id');
        $totalQuestions = Question::count();

        $averageTime = QuizResult::whereNotNull('time_taken')
            ->where('time_taken', '>', 0)
            ->avg('time_taken');
        $completionRate = $averageTime ? round($averageTime / 60, 1) : 0;

        $masterUsers = QuizResult::select('user_id')
            ->selectRaw('AVG(percentage) as avg_score')
            ->groupBy('user_id')
            ->having('avg_score', '>=', 80)
            ->count();

        return response()->json([
            'totalParticipants' => $totalParticipants,
            'totalQuestions' => $totalQuestions,
            'completionRate' => $completionRate,
            'masterUsers' => $masterUsers
        ]);
    }

    private function calculateLevel($score)
    {
        // PERBAIKAN: Gunakan bahasa Inggris untuk enum database
        if ($score >= 5000) return 'master';
        if ($score >= 3000) return 'expert';
        if ($score >= 1500) return 'advanced';
        if ($score >= 500) return 'intermediate';
        return 'beginner';
    }

    // Helper untuk menampilkan level dalam bahasa Indonesia di view
    public static function getLevelLabel($level)
    {
        $labels = [
            'beginner' => 'Pemula',
            'intermediate' => 'Menengah',
            'advanced' => 'Mahir',
            'expert' => 'Ahli',
            'master' => 'Master'
        ];

        return $labels[$level] ?? 'Pemula';
    }
}
