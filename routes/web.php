<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\KelasController;
use App\Http\Controllers\auth\ElibraryController;


Route::get('/', function () {
    return view('index');
});

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/elibrary', [ElibraryController::class, 'index'])->name('elibrary.index');
Route::get('/elibrary/{id}', [ElibraryController::class, 'show'])->name('elibrary.show');
Route::get('/elibrary/{id}/lihat', [ElibraryController::class, 'lihat'])->name('elibrary.lihat');
Route::get('/elibrary/{id}/unduh', [ElibraryController::class, 'unduh'])->name('elibrary.unduh');