<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\KelasController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ForumController;
use App\Http\Controllers\auth\EventController;
use App\Http\Controllers\auth\LibraryController;


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
