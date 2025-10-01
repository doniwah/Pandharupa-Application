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



//PERUBAHANKU
Route::get('/bahasa', [BahasaDaerahController::class, 'index'])->name('bahasa.index');
Route::get('/bahasa-madura', [BahasaDaerahController::class, 'bahasaMadura'])
    ->name('bahasa.bahasa_madura');
Route::get('/bahasa-jawa', [BahasaDaerahController::class, 'bahasaJawa'])
    ->name('bahasa.bahasa_jawa');
Route::get('/bahasa-osing', [BahasaDaerahController::class, 'bahasaOsing'])
    ->name('bahasa.bahasa_osing');
Route::get('/dasar-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.dasar_bahasa');
})->name('dasar.bahasa');
Route::get('/menengah-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.menengah_bahasa');
})->name('menengah.bahasa');
Route::get('/lanjutan-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.lanjutan_bahasa');
})->name('lanjutan.bahasa');

Route::get('/quiz', [QuizGamesController::class, 'index'])->name('quiz.index');
Route::get('/kolaborasi', [KolaborasiController::class, 'index'])->name('kolaborasi.index');
