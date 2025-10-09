    <?php

    use App\Http\Controllers\auth\BahasaDaerahController;
    use App\Http\Controllers\auth\QuizGamesController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\auth\KelasController;
    use App\Http\Controllers\auth\ElibraryController;
    use App\Http\Controllers\auth\KolaborasiController;

    Route::get('/', function () {
        return view('index');
    });

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/elibrary', [ElibraryController::class, 'index'])->name('elibrary.index');

    //PERUBAHANKU - BAHASA DAERAH

    // Main pages
    Route::get('/bahasa', [BahasaDaerahController::class, 'index'])->name('bahasa.index');
    Route::get('/bahasa/statistics', [BahasaDaerahController::class, 'getStatistics']);
    Route::get('/bahasa/{languageId}', [BahasaDaerahController::class, 'show'])->name('bahasa.show');

    // Learning Path
    Route::get('/bahasa/{languageId}/path/{pathId}', [BahasaDaerahController::class, 'showLearningPath'])
        ->name('bahasa.learning_path');

    // Lesson Routes - BERBEDA PATH
    // Lesson biasa (tampilan sederhana)
    Route::get('/bahasa/{languageId}/direct-lesson/{lessonId}', [BahasaDaerahController::class, 'showLesson'])
        ->name('bahasa.lesson');
    Route::get('/bahasa/{languageId}/lessons/{lessonId}', [BahasaDaerahController::class, 'showLesson'])
        ->name('bahasa.lesson');

    Route::post('/api/bahasa/{languageId}/lessons/{lessonId}/complete', [BahasaDaerahController::class, 'completeLesson'])
        ->name('bahasa.lesson.complete');

    Route::get('/api/bahasa/{languageId}/lessons/{lessonId}/status', [BahasaDaerahController::class, 'getLessonStatus'])
        ->name('bahasa.lesson.status');

    // Lesson dari learning path - PERBAIKAN: Tambahkan pathId sebagai parameter
    Route::get('/bahasa/{languageId}/path/{pathId}/lesson/{lessonId}', [BahasaDaerahController::class, 'showLesson_jalur'])
        ->name('bahasa.lesson_jalur');

    // API untuk complete lesson dari path
    Route::post('/api/bahasa/{languageId}/lesson/{lessonId}/complete', [BahasaDaerahController::class, 'completeLesson'])
        ->name('bahasa.lesson.complete');

    // API untuk get lesson contents
    Route::get('/api/bahasa/{languageId}/lesson/{lessonId}/contents', [BahasaDaerahController::class, 'getLessonContents'])
        ->name('bahasa.lesson.contents');

    // API untuk get path progress
    Route::get('/api/bahasa/{languageId}/path/{pathId}/progress', [BahasaDaerahController::class, 'getLearningPathProgress'])
        ->name('bahasa.path.progress');

    // API Routes
    Route::post('/api/bahasa/{languageId}/lesson/{lessonId}/complete', [BahasaDaerahController::class, 'completeLesson']);
    Route::get('/api/bahasa/{languageId}/lesson/{lessonId}/contents', [BahasaDaerahController::class, 'getLessonContents']);
    Route::get('/api/bahasa/{languageId}/progress', [BahasaDaerahController::class, 'getProgress']);
    Route::get('/api/bahasa/{languageId}/audio-phrases', [BahasaDaerahController::class, 'getAudioPhrases']);
    Route::get('/api/bahasa/{languageId}/paths', [BahasaDaerahController::class, 'getLearningPaths'])
        ->name('bahasa.paths');

    // QUIZ ROUTES
    Route::get('/quiz', [QuizGamesController::class, 'index'])->name('quiz.index');
    Route::get('/sejarah-budaya-quiz', function () {
        return view('pages.quiz_games.all_quiz.sejarah_budaya');
    })->name('sejarah-budaya-quiz');
    Route::get('/bahasa-daerah-quiz', function () {
        return view('pages.quiz_games.all_quiz.bahasa_daerah');
    })->name('bahasa-daerah-quiz');
    Route::get('/seni-kerajinan-quiz', function () {
        return view('pages.quiz_games.all_quiz.seni_kerajinan');
    })->name('seni-kerajinan-quiz');
    Route::get('/kuliner-tradisional-quiz', function () {
        return view('pages.quiz_games.all_quiz.kuliner_tradisional');
    })->name('kuliner-tradisional-quiz');
    Route::get('/tarian-musik-quiz', function () {
        return view('pages.quiz_games.all_quiz.tarian_musik');
    })->name('tarian-musik-quiz');
    Route::get('/upacara-adat-quiz', function () {
        return view('pages.quiz_games.all_quiz.upacara_adat');
    })->name('upacara-adat-quiz');

    // KOLABORASI
    Route::get('/kolaborasi', [KolaborasiController::class, 'index'])->name('kolaborasi.index');
