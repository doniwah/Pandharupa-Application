<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\KelasController;
use App\Http\Controllers\auth\ElibraryController;


Route::get('/', function () {
    return view('index');
});

Route::prefix('kelas-nusantara')->name('kelas.')->group(function () {
    // List semua kelas
    Route::get('/', [KelasController::class, 'index'])->name('index');

    // Detail kelas (list pelajaran)
    Route::get('/{id}', [KelasController::class, 'show'])->name('show');

    // Baca pelajaran
    Route::get('/{kelasId}/pelajaran/{pelajaranId}', [KelasController::class, 'bacaPelajaran'])->name('baca');

    // Routes yang memerlukan authentication
    Route::middleware(['auth'])->group(function () {
        // Update progress (auto-save saat membuka pelajaran)
        Route::post('/{kelasId}/pelajaran/{pelajaranId}/update-progress', [KelasController::class, 'updateProgress'])
            ->name('update-progress');

        // Mark lesson as complete
        Route::post('/{kelasId}/pelajaran/{pelajaranId}/complete', [KelasController::class, 'markComplete'])
            ->name('mark-complete');

        // Get progress
        Route::get('/{kelasId}/progress', [KelasController::class, 'getProgress'])
            ->name('progress');
    });
});


Route::get('/elibrary', [ElibraryController::class, 'index'])->name('elibrary.index');
Route::get('/elibrary/{id}', [ElibraryController::class, 'show'])->name('elibrary.show');
Route::get('/elibrary/{id}/lihat', [ElibraryController::class, 'lihat'])->name('elibrary.lihat');
Route::get('/elibrary/{id}/unduh', [ElibraryController::class, 'unduh'])->name('elibrary.unduh');
