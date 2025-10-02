<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $pelajaran = [
            [
                'kelas_id' => 2, // Tarian Tradisional Pendalungan
                'judul' => 'Pengenalan Tarian Pendalungan',
                'durasi' => 15,
                'deskripsi' => 'Memahami akar budaya dan makna tarian tradisional Pendalungan.',
                'urutan' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kelas_id' => 2,
                'judul' => 'Tari Gandrung - Ikon Budaya',
                'durasi' => 30,
                'deskripsi' => 'Belajar gerakan dasar tari Gandrung dan filosofi di baliknya.',
                'urutan' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kelas_id' => 2,
                'judul' => 'Filosofi Gerakan Tarian',
                'durasi' => 20,
                'deskripsi' => 'Menggali makna filosofis dari setiap gerakan dalam tarian tradisional.',
                'urutan' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('pelajaran')->insert($pelajaran);
    }
}