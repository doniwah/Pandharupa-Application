<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\KelasController;
use App\Http\Controllers\auth\ElibraryController;


Route::get('/', function () {
    return view('index');
});

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/elibrary', [ElibraryController::class, 'index'])->name('elibrary.index');