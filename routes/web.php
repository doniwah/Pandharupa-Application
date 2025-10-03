<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\KelasController;
use App\Http\Controllers\auth\ElibraryController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ForumController;


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

Route::get('/elibrary', [ElibraryController::class, 'index'])->name('elibrary.index');
Route::get('/elibrary/{id}', [ElibraryController::class, 'show'])->name('elibrary.show');
Route::get('/elibrary/{id}/lihat', [ElibraryController::class, 'lihat'])->name('elibrary.lihat');
Route::get('/elibrary/{id}/unduh', [ElibraryController::class, 'unduh'])->name('elibrary.unduh');

// Login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');