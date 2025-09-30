<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{


    public function index()
    {
        // Ambil semua data kelas, urutkan berdasarkan kolom 'urutan'
        $kelasList = DB::table('kelas')
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        // Hitung statistik (bisa disesuaikan dengan kebutuhan)
        $stats = [
            'total_materi' => DB::table('kelas')->sum('jumlah_pelajaran'),
            'pelajar_aktif' => 2450, // Bisa dari tabel users atau pelajar
            'tingkat_kepuasan' => 98,
            'akses' => '24/7'
        ];
        return view('pages.kelas_nusantara.kelas', compact('kelasList', 'stats'));
    }
}