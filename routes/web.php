<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\KelasController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ForumController;
use App\Http\Controllers\auth\EventController;
use App\Http\Controllers\auth\LibraryController;
use App\Http\Controllers\auth\BahasaDaerahController;
use App\Http\Controllers\auth\QuizGamesController;
use App\Http\Controllers\auth\ElibraryController;
use App\Http\Controllers\auth\KolaborasiController;

Route::get('/', function () {
    return view('index');
});

Route::prefix('kelas-nusantara')->name('kelas.')->group(function () {

    Route::get('/', [KelasController::class, 'index'])->name('index');
    Route::get('/{id}', [KelasController::class, 'show'])->name('show');
    Route::get('/{kelasId}/pelajaran/{pelajaranId}', [KelasController::class, 'bacaPelajaran'])->name('baca');
    Route::middleware(['auth'])->group(function () {
        Route::post('/{kelasId}/pelajaran/{pelajaranId}/update-progress', [KelasController::class, 'updateProgress'])
            ->name('update-progress');
        Route::post('/{kelasId}/pelajaran/{pelajaranId}/complete', [KelasController::class, 'markComplete'])
            ->name('mark-complete');
        Route::get('/{kelasId}/progress', [KelasController::class, 'getProgress'])
            ->name('progress');
    });
});
Route::get('/login', [LoginController::class, 'index'])->name('login.index');


Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [ForumController::class, 'storeReply'])->name('forum.reply');
    Route::post('/forum/{id}/like', [ForumController::class, 'toggleLike'])->name('forum.like');
});

Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
Route::get('/library/{id}', [LibraryController::class, 'show'])->name('library.show');
Route::get('/library/{id}/download', [LibraryController::class, 'download'])->name('library.download');
// Login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::post('/events/{id}/register', [EventController::class, 'register'])->name('events.register');

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

// Quiz routes
Route::get('/quiz', [QuizGamesController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{id}', [QuizGamesController::class, 'showQuiz'])->name('quiz.show');
Route::post('/quiz/{quiz}/submit', [QuizGamesController::class, 'submitQuiz'])->name('quiz.submit');
Route::get('/quiz/stats', [QuizGamesController::class, 'getStats'])->name('quiz.stats'); // PERBAIKAN: Pakai QuizGamesController

// KOLABORASI
Route::get('/kolaborasi', [KolaborasiController::class, 'index'])->name('kolaborasi.index');
Route::get('/kolaborasi/{id}', [KolaborasiController::class, 'show'])->name('kolaborasi.show');
Route::post('/kolaborasi/store', [KolaborasiController::class, 'store'])->name('kolaborasi.store');
Route::get('/kolaborasi/{id}/download', [KolaborasiController::class, 'download'])->name('kolaborasi.download');
Route::post('/kolaborasi/{id}/like', [KolaborasiController::class, 'like'])->name('kolaborasi.like');
Route::get('/kolaborasi/category/{category}', [KolaborasiController::class, 'index'])->name('kolaborasi.category');