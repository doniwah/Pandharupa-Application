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
//BAHASA MADURA
Route::get('/bahasa-madura', [BahasaDaerahController::class, 'bahasaMadura'])
    ->name('bahasa.bahasa_madura');
Route::get('/pengenalan-bahasa-madura', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_madura.pengenalan_bahasa_madura');
})->name('pengenalan-madura.bahasa');
Route::get('/sapaan-bahasa-madura', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_madura.sapaan_perkenalan');
})->name('sapaan-madura.bahasa');
Route::get('/angka-bahasa-madura', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_madura.angka');
})->name('angka-madura.bahasa');
Route::get('/kosakata-keluarga-bahasa-madura', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_madura.kosakata_keluarga');
})->name('kosakata-keluarga-madura.bahasa');
//BAHASA JAWA
Route::get('/bahasa-jawa', [BahasaDaerahController::class, 'bahasaJawa'])
    ->name('bahasa.bahasa_jawa');
Route::get('/aksara-jawa-bahasa-jawa', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_jawa.aksara_jawa');
})->name('aksara-jawa.bahasa');
Route::get('/tutur-ngoko-bahasa-jawa', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_jawa.tutur_ngoko');
})->name('tutur-ngoko.bahasa');
Route::get('/tutur-krama-bahasa-jawa', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_jawa.tutur_krama');
})->name('tutur-krama.bahasa');
Route::get('/percakapan-bahasa-jawa', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_jawa.percakapan_sehari');
})->name('percakapan-sehari.bahasa');
//BAHASA OSING
Route::get('/bahasa-osing', [BahasaDaerahController::class, 'bahasaOsing'])
    ->name('bahasa.bahasa_osing');
Route::get('/pengenalan-bahasa-osing', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_osing.pengenalan_bahasa_osing');
})->name('pengenalan-osing.bahasa');
Route::get('/kosakata-dasar-osing', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_osing.kosakata_dasar');
})->name('kosakata-dasar-osing.bahasa');
Route::get('/percakapan-dasar-osing', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_osing.percakapan_dasar');
})->name('percakapan-dasar-osing.bahasa');
Route::get('/lagu-dan-pantun-osing', function () {
    return view('pages.bahasa_daerah.other_bahasa.pengenalan_bahasa.bahasa_osing.lagu_pantun');
})->name('lagu-pantun-osing.bahasa');

//DASAR DASAR
Route::get('/dasar-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.dasar_bahasa');
})->name('dasar.bahasa');
Route::get('/pengenalan-huruf-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.dasar_dasar_bahasa.pengenalan_huruf_madura');
})->name('pengenalan-huruf.bahasa');
Route::get('/kosakata-sehari-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.dasar_dasar_bahasa.kosakata_seharihari');
})->name('kosakata-sehari.bahasa');
Route::get('/angka-waktu-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.dasar_dasar_bahasa.angka_waktu');
})->name('angka-waktu.bahasa');
Route::get('/keluarga-profesi-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.dasar_dasar_bahasa.keluarga_profesi');
})->name('keluarga-dan-profesi.bahasa');


Route::get('/menengah-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.menengah_bahasa');
})->name('menengah.bahasa');
Route::get('/berkenalan-sapa-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.percakapan_praktis.berkenalan_sapa');
})->name('berkenalan-dan-sapa.bahasa');
Route::get('/berbelanja-di-pasar-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.percakapan_praktis.berbelanja_pasar');
})->name('berbelanja-pasar.bahasa');
Route::get('/tanya-transportasi-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.percakapan_praktis.tanya_transportasi');
})->name('tanya-transportasi.bahasa');
Route::get('/makanan-minuman-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.percakapan_praktis.makan_minuman');
})->name('makanan-minuman.bahasa');

Route::get('/lanjutan-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.lanjutan_bahasa');
})->name('lanjutan.bahasa');
Route::get('/upacara-adat-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.budaya_tradisi.upacara_adat');
})->name('upacara-adat.bahasa');
Route::get('/cerita-rakyat-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.budaya_tradisi.cerita_rakyat');
})->name('cerita-rakyat.bahasa');
Route::get('/pantun-puisi-lanjutan-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.budaya_tradisi.pantun_puisi');
})->name('pantun-puisi-lanjutan.bahasa');
Route::get('/percakapan-formal-lanjutan-bahasa', function () {
    return view('pages.bahasa_daerah.jalur_pembelajaran.budaya_tradisi.percakapan_formal');
})->name('percakapan-formal-lanjutan.bahasa');

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

Route::get('/kolaborasi', [KolaborasiController::class, 'index'])->name('kolaborasi.index');
