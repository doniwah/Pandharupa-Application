<?php

use App\Http\Controllers\auth\BahasaDaerahController;
use App\Http\Controllers\auth\QuizGamesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\KelasController;
use App\Http\Controllers\auth\ElibraryController;


Route::get('/', function () {
    return view('index');
});

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/elibrary', [ElibraryController::class, 'index'])->name('elibrary.index');



//PERUBAHANKU
Route::get('/bahasa', [BahasaDaerahController::class, 'index'])->name('bahasa.index');
Route::get('/quiz', [QuizGamesController::class, 'index'])->name('quiz.index');
