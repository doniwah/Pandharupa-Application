<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Models\bahasa\Lesson;
use App\Models\bahasa\Language;
use App\Models\bahasa\AudioPhrase;
use Illuminate\Support\Facades\DB;
use App\Models\bahasa\LearningPath;
use App\Models\bahasa\UserProgress;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\bahasa\LessonCompletion;
use App\Models\bahasa\LearningPathProgress;

class BahasaDaerahController extends Controller
{
    /**
     * Display the main language learning page (index)
     */
    public function index()
    {
        $userId = Auth::id() ?? 1;

        $languages = Language::all()->map(function ($language) use ($userId) {
            // Get or create user progress
            $progress = UserProgress::firstOrCreate(
                [
                    'user_id' => $userId,
                    'language_id' => $language->id
                ],
                [
                    'progress_percentage' => 0,
                    'completed_lessons' => 0,
                    'study_time' => 0,
                    'streak' => 0
                ]
            );

            // PERBAIKAN: Recalculate progress hanya untuk lessons biasa
            $completedCount = LessonCompletion::where('user_id', $userId)
                ->whereHas('lesson', function ($query) use ($language) {
                    $query->where('language_id', $language->id)
                        ->whereDoesntHave('learningPaths');
                })
                ->where('completed', true)
                ->count();

            $totalLessons = Lesson::where('language_id', $language->id)
                ->whereDoesntHave('learningPaths')
                ->count();

            $progressPercentage = $totalLessons > 0
                ? min(100, ($completedCount / $totalLessons) * 100)
                : 0;

            // Update progress
            $progress->update([
                'progress_percentage' => round($progressPercentage, 2),
                'completed_lessons' => $completedCount
            ]);

            return [
                'id' => $language->id,
                'name' => $language->name,
                'native_name' => $language->native_name,
                'difficulty' => $language->difficulty,
                'indicator_color' => $language->indicator_color,
                'speakers' => $language->speakers,
                'total_lessons' => $totalLessons, // PERBAIKAN: Gunakan total lessons biasa
                'progress' => round($progressPercentage, 2),
                'route' => route('bahasa.show', $language->id)
            ];
        });

        // Get all learning paths dari semua bahasa
        $learningPaths = LearningPath::with('language')
            ->orderBy('language_id')
            ->orderBy('order')
            ->get()
            ->map(function ($path) use ($userId) {
                // Get or create progress
                $progress = LearningPathProgress::firstOrCreate(
                    [
                        'user_id' => $userId,
                        'learning_path_id' => $path->id
                    ],
                    [
                        'completed_lessons' => 0,
                        'progress_percentage' => 0,
                        'started_at' => now()
                    ]
                );

                // Recalculate dari database
                $completedCount = LessonCompletion::where('user_id', $userId)
                    ->where('completed', true)
                    ->whereHas('lesson', function ($query) use ($path) {
                        $query->whereHas('learningPaths', function ($q) use ($path) {
                            $q->where('learning_path_id', $path->id);
                        });
                    })
                    ->count();

                // Update progress
                $progress->update([
                    'completed_lessons' => $completedCount,
                    'progress_percentage' => $path->total_lessons > 0
                        ? round(($completedCount / $path->total_lessons) * 100, 2)
                        : 0
                ]);

                // Get lessons untuk path ini
                $lessons = $path->lessons()->orderBy('order')->get();

                return [
                    'id' => $path->id,
                    'language_id' => $path->language_id,
                    'name' => $path->name,
                    'level' => $path->level,
                    'description' => $path->description,
                    'total_lessons' => $path->total_lessons,
                    'completed_lessons' => $completedCount,
                    'progress_percentage' => $progress->progress_percentage,
                    'lessons' => $lessons->map(function ($lesson) {
                        return [
                            'title' => $lesson->title
                        ];
                    }),
                    'route' => route('bahasa.learning_path', [$path->language_id, $path->id])
                ];
            });

        // STATISTICS dari database
        $statistics = [
            // Total pelajar aktif (users yang punya progress di bulan ini)
            'active_learners' => UserProgress::whereHas('user')
                ->where('updated_at', '>=', now()->subMonth())
                ->distinct('user_id')
                ->count('user_id'),

            // Total kosakata tersedia (dari lesson contents)
            'total_vocabulary' => DB::table('lesson_contents')->count(),

            // Total audio native speaker
            'total_audio' => AudioPhrase::count(),

            // Tingkat kepuasan (rata-rata completion rate dari semua user)
            'satisfaction_rate' => $this->calculateSatisfactionRate()
        ];

        return view('pages/bahasa_daerah.index', compact('languages', 'learningPaths', 'statistics'));
    }

    /**
     * Calculate satisfaction rate based on user completion rates
     */
    private function calculateSatisfactionRate()
    {
        $userProgresses = UserProgress::whereHas('user')
            ->where('progress_percentage', '>', 0)
            ->get();

        if ($userProgresses->isEmpty()) {
            return 95; // Default value
        }

        $averageProgress = $userProgresses->avg('progress_percentage');

        // Convert progress to satisfaction (scale to 85-100%)
        $satisfaction = 85 + ($averageProgress * 0.15);

        return round(min($satisfaction, 100));
    }

    public function show($languageId)
    {
        $userId = Auth::id() ?? 1;
        $language = Language::findOrFail($languageId);

        // Get or create user progress
        $userProgress = UserProgress::firstOrCreate(
            [
                'user_id' => $userId,
                'language_id' => $languageId
            ],
            [
                'progress_percentage' => 0,
                'completed_lessons' => 0,
                'study_time' => 0,
                'streak' => 0
            ]
        );

        // Update streak
        $userProgress->updateStreak();

        // Hanya ambil lessons yang TIDAK termasuk dalam learning path manapun
        $lessons = Lesson::where('language_id', $languageId)
            ->whereDoesntHave('learningPaths')
            ->orderBy('order')
            ->get()
            ->map(function ($lesson) use ($userId, $languageId) {
                $completion = LessonCompletion::where('user_id', $userId)
                    ->where('lesson_id', $lesson->id)
                    ->first();

                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'status' => $completion && $completion->completed ? 'Selesai' : 'Belum Selesai',
                    'completed' => $completion && $completion->completed,
                    'route' => route('bahasa.lesson', [$languageId, $lesson->id])
                ];
            });

        // PERBAIKAN: Hitung progress hanya berdasarkan lessons biasa
        $completedCount = LessonCompletion::where('user_id', $userId)
            ->whereHas('lesson', function ($query) use ($languageId) {
                $query->where('language_id', $languageId)
                    ->whereDoesntHave('learningPaths');
            })
            ->where('completed', true)
            ->count();

        $totalLessons = Lesson::where('language_id', $languageId)
            ->whereDoesntHave('learningPaths')
            ->count();

        // PERBAIKAN: Progress maksimal 100%
        $progress = $totalLessons > 0 ? min(100, ($completedCount / $totalLessons) * 100) : 0;

        // Statistics - hanya untuk lessons biasa
        $stats = [
            'completed_lessons' => $completedCount . '/' . $totalLessons,
            'study_time' => $this->formatStudyTime($userProgress->study_time),
            'streak' => $userProgress->streak . ' hari'
        ];

        // PERBAIKAN: Update user progress dengan progress yang benar
        $userProgress->update([
            'progress_percentage' => round($progress, 2),
            'completed_lessons' => $completedCount
        ]);

        return view('pages/bahasa_daerah.show', compact('language', 'lessons', 'stats', 'progress'));
    }

    public function showLesson($languageId, $lessonId)
    {
        $userId = Auth::id() ?? 1;
        $language = Language::findOrFail($languageId);
        $lesson = Lesson::findOrFail($lessonId);

        // Validasi lesson belongs to language
        if ($lesson->language_id != $languageId) {
            abort(404, 'Pelajaran tidak ditemukan');
        }

        // Ensure user progress exists
        UserProgress::firstOrCreate(
            [
                'user_id' => $userId,
                'language_id' => $languageId
            ],
            [
                'progress_percentage' => 0,
                'completed_lessons' => 0,
                'study_time' => 0,
                'streak' => 0
            ]
        );

        // Mark lesson as viewed
        LessonCompletion::firstOrCreate(
            [
                'user_id' => $userId,
                'lesson_id' => $lessonId
            ],
            [
                'completed' => false
            ]
        );
        return view('pages.bahasa_daerah.lesson', compact('language', 'lesson'));
    }

    private function formatStudyTime($minutes)
    {
        if ($minutes < 60) {
            return $minutes . ' menit';
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($remainingMinutes > 0) {
            return $hours . ' jam ' . $remainingMinutes . ' menit';
        }

        return $hours . ' jam';
    }

    public function getProgress($languageId)
    {
        $userId = Auth::id() ?? 1;
        $language = Language::findOrFail($languageId);

        // Get user progress
        $userProgress = UserProgress::where('user_id', $userId)
            ->where('language_id', $languageId)
            ->first();

        if (!$userProgress) {
            $userProgress = UserProgress::create([
                'user_id' => $userId,
                'language_id' => $languageId,
                'progress_percentage' => 0,
                'completed_lessons' => 0,
                'study_time' => 0,
                'streak' => 0
            ]);
        }

        // Hanya ambil lessons yang TIDAK termasuk dalam learning path
        $lessons = Lesson::where('language_id', $languageId)
            ->whereDoesntHave('learningPaths')
            ->orderBy('order')
            ->get()
            ->map(function ($lesson) use ($userId) {
                $completion = LessonCompletion::where('user_id', $userId)
                    ->where('lesson_id', $lesson->id)
                    ->first();

                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'status' => $completion && $completion->completed ? 'Selesai' : 'Belum Selesai',
                    'completed' => $completion && $completion->completed ? true : false,
                ];
            });

        // PERBAIKAN: Hitung progress hanya untuk lessons biasa
        $completedCount = LessonCompletion::where('user_id', $userId)
            ->whereHas('lesson', function ($query) use ($languageId) {
                $query->where('language_id', $languageId)
                    ->whereDoesntHave('learningPaths');
            })
            ->where('completed', true)
            ->count();

        $totalLessons = Lesson::where('language_id', $languageId)
            ->whereDoesntHave('learningPaths')
            ->count();

        // PERBAIKAN: Progress maksimal 100%
        $progress = $totalLessons > 0 ? min(100, ($completedCount / $totalLessons) * 100) : 0;

        $stats = [
            'completed_lessons' => $completedCount . '/' . $totalLessons,
            'study_time' => $this->formatStudyTime($userProgress->study_time),
            'streak' => $userProgress->streak . ' hari'
        ];

        // PERBAIKAN: Update progress di database
        $userProgress->update([
            'progress_percentage' => round($progress, 2),
            'completed_lessons' => $completedCount
        ]);

        return response()->json([
            'progress' => $progress,
            'stats' => $stats,
            'lessons' => $lessons
        ]);
    }

    public function completeLesson(Request $request, $languageId, $lessonId)
    {
        $userId = Auth::id() ?? 1;

        // Validasi lesson exists dan belongs to language
        $lesson = Lesson::where('id', $lessonId)
            ->where('language_id', $languageId)
            ->firstOrFail();

        // Get study time from request (in minutes)
        $studyTimeMinutes = $request->input('study_time', 5);
        $actualSeconds = $request->input('actual_seconds', 0);

        // Deteksi tipe completion: 'scroll' untuk lesson biasa, 'button' untuk lesson jalur
        $completionType = $request->input('completion_type', 'scroll');

        // Check if already completed
        $completion = LessonCompletion::where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->first();

        if ($completion && $completion->completed) {
            return response()->json([
                'success' => true,
                'message' => 'Pelajaran sudah diselesaikan sebelumnya',
                'already_completed' => true,
                'completion_type' => $completionType
            ]);
        }

        // Mark lesson as completed
        $completion = LessonCompletion::updateOrCreate(
            [
                'user_id' => $userId,
                'lesson_id' => $lessonId
            ],
            [
                'completed' => true,
                'completed_at' => now(),
                'study_time_seconds' => $actualSeconds,
                'completion_type' => $completionType
            ]
        );

        // PERBAIKAN: Update progress berdasarkan jenis lesson
        $this->updateProgressBasedOnLessonType($userId, $languageId, $lessonId, $studyTimeMinutes);

        return response()->json([
            'success' => true,
            'message' => $completionType === 'button'
                ? 'Selamat! Anda telah menyelesaikan semua materi.'
                : 'Pelajaran berhasil diselesaikan',
            'study_time_formatted' => $this->formatStudyTime($studyTimeMinutes),
            'already_completed' => false,
            'completion_type' => $completionType
        ]);
    }

    // Method baru untuk complete lesson jalur (dipanggil dari button)
    public function completeLessonJalur(Request $request, $languageId, $lessonId)
    {
        // Sama seperti completeLesson tapi dengan completion_type = 'button'
        $request->merge(['completion_type' => 'button']);
        return $this->completeLesson($request, $languageId, $lessonId);
    }

    public function getLearningPathProgress($languageId, $pathId)
    {
        $userId = Auth::id() ?? 1;

        $learningPath = LearningPath::with('lessons')->findOrFail($pathId);

        // RECALCULATE dari database langsung
        $completedCount = LessonCompletion::where('user_id', $userId)
            ->where('completed', true)
            ->whereHas('lesson', function ($query) use ($learningPath) {
                $query->whereHas('learningPaths', function ($q) use ($learningPath) {
                    $q->where('learning_path_id', $learningPath->id);
                });
            })
            ->count();

        // Update progress record
        $pathProgress = LearningPathProgress::firstOrCreate(
            [
                'user_id' => $userId,
                'learning_path_id' => $pathId
            ],
            [
                'completed_lessons' => 0,
                'progress_percentage' => 0,
                'started_at' => now()
            ]
        );

        // Update dengan data terbaru
        $pathProgress->completed_lessons = $completedCount;
        $pathProgress->updateProgress();
        $pathProgress->save();

        $progressPercentage = $learningPath->total_lessons > 0
            ? ($completedCount / $learningPath->total_lessons) * 100
            : 0;

        Log::info('Learning Path Progress API', [
            'user_id' => $userId,
            'path_id' => $pathId,
            'completed_lessons' => $completedCount,
            'total_lessons' => $learningPath->total_lessons,
            'progress_percentage' => $progressPercentage
        ]);

        return response()->json([
            'completed_lessons' => $completedCount,
            'total_lessons' => $learningPath->total_lessons,
            'progress_percentage' => round($progressPercentage, 2)
        ]);
    }

    private function updateUserProgress($userId, $languageId, $additionalStudyTime = 0)
    {
        // PERBAIKAN: Count completed lessons hanya yang biasa (tanpa learning path)
        $completedCount = LessonCompletion::where('user_id', $userId)
            ->whereHas('lesson', function ($query) use ($languageId) {
                $query->where('language_id', $languageId)
                    ->whereDoesntHave('learningPaths');
            })
            ->where('completed', true)
            ->count();

        // Hitung total lessons hanya yang biasa
        $totalLessons = Lesson::where('language_id', $languageId)
            ->whereDoesntHave('learningPaths')
            ->count();

        // PERBAIKAN: Progress maksimal 100%
        $progressPercentage = $totalLessons > 0
            ? min(100, ($completedCount / $totalLessons) * 100)
            : 0;

        // Update user progress
        $userProgress = UserProgress::updateOrCreate(
            [
                'user_id' => $userId,
                'language_id' => $languageId
            ],
            [
                'progress_percentage' => round($progressPercentage, 2),
                'completed_lessons' => $completedCount
            ]
        );

        // Update study time
        if ($additionalStudyTime > 0) {
            $userProgress->increment('study_time', $additionalStudyTime);
        }

        // Update streak
        $userProgress->updateStreak();
    }

    public function getLessonStatus($languageId, $lessonId)
    {
        $userId = Auth::id() ?? 1;

        // Validasi lesson exists dan belongs to language
        $lesson = Lesson::where('id', $lessonId)
            ->where('language_id', $languageId)
            ->firstOrFail();

        // Check if lesson is completed
        $completion = LessonCompletion::where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->first();

        return response()->json([
            'completed' => $completion && $completion->completed ? true : false,
            'completed_at' => $completion && $completion->completed_at ? $completion->completed_at->format('Y-m-d H:i:s') : null
        ]);
    }

    public function getAudioPhrases($languageId)
    {
        $phrases = AudioPhrase::where('language_id', $languageId)
            ->orderBy('order')
            ->get()
            ->map(function ($phrase) {
                // Generate full URL untuk audio file
                $audioUrl = null;
                if ($phrase->audio_file) {
                    $audioUrl = asset('storage/' . $phrase->audio_file);

                    // Cek jika file exists di storage
                    $filePath = storage_path('app/public/' . $phrase->audio_file);
                    if (!file_exists($filePath)) {
                        Log::warning("Audio file not found: " . $filePath);
                        $audioUrl = null;
                    }
                }

                return [
                    'id' => $phrase->id,
                    'indonesian' => $phrase->indonesian,
                    'local_language' => $phrase->local_language,
                    'audio_file' => $audioUrl, // Tetap gunakan audio_file untuk konsistensi
                    'audio_url' => $audioUrl   // Tambahkan alias untuk backup
                ];
            });

        Log::info("Audio phrases loaded", [
            'language_id' => $languageId,
            'count' => $phrases->count(),
            'phrases' => $phrases->toArray()
        ]);

        return response()->json($phrases);
    }

    public function showLearningPath($languageId, $pathId)
    {
        $userId = Auth::id() ?? 1;
        $language = Language::findOrFail($languageId);
        $learningPath = LearningPath::with('lessons')->findOrFail($pathId);

        // Get atau create progress
        $pathProgress = LearningPathProgress::firstOrCreate(
            [
                'user_id' => $userId,
                'learning_path_id' => $pathId
            ],
            [
                'completed_lessons' => 0,
                'progress_percentage' => 0,
                'started_at' => now()
            ]
        );

        // Get lessons dengan status completion
        $lessons = $learningPath->lessons->map(function ($lesson, $index) use ($userId, $languageId, $pathId) {
            $completion = LessonCompletion::where('user_id', $userId)
                ->where('lesson_id', $lesson->id)
                ->first();

            // PERBAIKAN: Gunakan route name yang benar dengan pathId
            $route = route('bahasa.lesson_jalur', [
                'languageId' => $languageId,
                'pathId' => $pathId,
                'lessonId' => $lesson->id
            ]);

            return [
                'id' => $lesson->id,
                'title' => $lesson->title,
                'topic_number' => $index + 1,
                'status' => $completion && $completion->completed ? 'Selesai' : 'Topik ' . ($index + 1),
                'completed' => $completion && $completion->completed,
                'route' => $route
            ];
        });

        $totalLessons = $learningPath->lessons->count();
        $completedLessons = $pathProgress->completed_lessons;

        return view('pages.bahasa_daerah.learning_path', compact(
            'language',
            'learningPath',
            'lessons',
            'pathProgress',
            'totalLessons',
            'completedLessons'
        ));
    }

    public function getLearningPaths($languageId)
    {
        $userId = Auth::id() ?? 1;

        $paths = LearningPath::where('language_id', $languageId)
            ->orderBy('order')
            ->get()
            ->map(function ($path) use ($userId) {
                $progress = LearningPathProgress::where('user_id', $userId)
                    ->where('learning_path_id', $path->id)
                    ->first();

                return [
                    'id' => $path->id,
                    'name' => $path->name,
                    'level' => $path->level,
                    'description' => $path->description,
                    'total_lessons' => $path->total_lessons,
                    'completed_lessons' => $progress ? $progress->completed_lessons : 0,
                    'progress_percentage' => $progress ? $progress->progress_percentage : 0,
                    // 'route' => route('bahasa.learning_path', [$languageId, $path->id])
                ];
            });

        return response()->json($paths);
    }

    /**
     * Update learning path progress secara terpisah
     */
    private function updateLearningPathProgress($userId, $lessonId)
    {
        // Cari semua learning path yang memiliki lesson ini
        $learningPaths = LearningPath::whereHas('lessons', function ($query) use ($lessonId) {
            $query->where('lesson_id', $lessonId);
        })->get();

        foreach ($learningPaths as $path) {
            // Get atau create progress
            $pathProgress = LearningPathProgress::firstOrCreate(
                [
                    'user_id' => $userId,
                    'learning_path_id' => $path->id
                ],
                [
                    'completed_lessons' => 0,
                    'progress_percentage' => 0,
                    'started_at' => now()
                ]
            );

            // Hitung berapa lesson yang sudah completed dalam path ini
            $completedCount = LessonCompletion::where('user_id', $userId)
                ->where('completed', true)
                ->whereHas('lesson', function ($query) use ($path) {
                    $query->whereHas('learningPaths', function ($q) use ($path) {
                        $q->where('learning_path_id', $path->id);
                    });
                })
                ->count();

            // Update progress
            $pathProgress->completed_lessons = $completedCount;
            $pathProgress->progress_percentage = $path->total_lessons > 0
                ? round(($completedCount / $path->total_lessons) * 100, 2)
                : 0;
            $pathProgress->save();
        }
    }


    public function showLesson_jalur($languageId, $pathId, $lessonId)
    {
        $userId = Auth::id() ?? 1;
        $language = Language::findOrFail($languageId);
        $lesson = Lesson::with('contents')->findOrFail($lessonId);

        // Validasi lesson belongs to language
        if ($lesson->language_id != $languageId) {
            abort(404, 'Pelajaran tidak ditemukan');
        }

        // Log untuk debug
        Log::info('showLesson_jalur called', [
            'languageId' => $languageId,
            'pathId' => $pathId,
            'lessonId' => $lessonId,
            'pathId_type' => gettype($pathId)
        ]);

        // Ensure user progress exists
        UserProgress::firstOrCreate(
            [
                'user_id' => $userId,
                'language_id' => $languageId
            ],
            [
                'progress_percentage' => 0,
                'completed_lessons' => 0,
                'study_time' => 0,
                'streak' => 0
            ]
        );

        // Mark lesson as viewed
        LessonCompletion::firstOrCreate(
            [
                'user_id' => $userId,
                'lesson_id' => $lessonId
            ],
            [
                'completed' => false
            ]
        );

        // Get lesson contents
        $contents = $lesson->contents;

        // CRITICAL: Pass pathId to view
        return view('pages.bahasa_daerah.lesson_jalur', compact('language', 'lesson', 'contents', 'pathId'));
    }


    // API endpoint untuk get lesson contents
    public function getLessonContents($languageId, $lessonId)
    {
        $lesson = Lesson::with('contents')->findOrFail($lessonId);

        if ($lesson->language_id != $languageId) {
            return response()->json(['error' => 'Lesson not found'], 404);
        }

        $contents = $lesson->contents->map(function ($content) {
            return [
                'id' => $content->id,
                'word' => $content->word,
                'meaning' => $content->meaning,
                'example' => $content->example,
                'pronunciations' => $content->pronunciations,
                'tip' => $content->tip,
                'audio_url' => $content->audio_file ? asset('storage/' . $content->audio_file) : null
            ];
        });

        return response()->json($contents);
    }

    /**
     * Update progress berdasarkan jenis lesson (biasa atau learning path)
     */
    private function updateProgressBasedOnLessonType($userId, $languageId, $lessonId, $studyTimeMinutes = 0)
    {
        $lesson = Lesson::find($lessonId);

        // Cek apakah lesson ini termasuk dalam learning path
        $isInLearningPath = $lesson->learningPaths()->exists();

        if ($isInLearningPath) {
            // Jika lesson dari learning path, update learning path progress saja
            $this->updateLearningPathProgress($userId, $lessonId);
        } else {
            // Jika lesson biasa, update user progress biasa
            $this->updateUserProgress($userId, $languageId, $studyTimeMinutes);
        }

        // PERBAIKAN: Update study time untuk semua case
        $userProgress = UserProgress::where('user_id', $userId)
            ->where('language_id', $languageId)
            ->first();

        if ($userProgress) {
            $userProgress->increment('study_time', $studyTimeMinutes);
            $userProgress->updateStreak();
        }
    }
}
