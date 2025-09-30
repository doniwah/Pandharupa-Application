<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            [
                'judul' => 'Sejarah Budaya Pendalungan',
                'deskripsi' => 'Pelajari asal-usul dan perkembangan budaya Pendalungan dari masa ke masa',
                'icon' => '🏛️',
                'kategori' => 'Pemula',
                'warna_kategori' => '#FF8C42',
                'jumlah_pelajaran' => 12,
                'durasi' => 4,
                'url_kelas' => '/kelas/sejarah-budaya-pendalungan',
                'status' => true,
                'urutan' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Tarian Tradisional Pendalungan',
                'deskripsi' => 'Kuasai gerakan dan filosofi di balik tarian tradisional daerah',
                'icon' => '🎭',
                'kategori' => 'Menengah',
                'warna_kategori' => '#FF8C42',
                'jumlah_pelajaran' => 18,
                'durasi' => 6,
                'url_kelas' => '/kelas/tarian-tradisional-pendalungan',
                'status' => true,
                'urutan' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Musik dan Instrumen Tradisional',
                'deskripsi' => 'Belajar memainkan alat musik tradisional Pendalungan',
                'icon' => '🎵',
                'kategori' => 'Pemula',
                'warna_kategori' => '#FF8C42',
                'jumlah_pelajaran' => 24,
                'durasi' => 8,
                'url_kelas' => '/kelas/musik-instrumen-tradisional',
                'status' => true,
                'urutan' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Kuliner Khas Pendalungan',
                'deskripsi' => 'Resep autentik dan teknik memasak makanan tradisional',
                'icon' => '🍲',
                'kategori' => 'Pemula',
                'warna_kategori' => '#FF8C42',
                'jumlah_pelajaran' => 9,
                'durasi' => 3,
                'url_kelas' => '/kelas/kuliner-khas-pendalungan',
                'status' => true,
                'urutan' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Kerajinan Tangan Tradisional',
                'deskripsi' => 'Teknik pembuatan kerajinan khas daerah Pendalungan',
                'icon' => '🎨',
                'kategori' => 'Menengah',
                'warna_kategori' => '#FF8C42',
                'jumlah_pelajaran' => 15,
                'durasi' => 5,
                'url_kelas' => '/kelas/kerajinan-tangan-tradisional',
                'status' => true,
                'urutan' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Sastra dan Cerita Rakyat',
                'deskripsi' => 'Eksplorasi kekayaan sastra dan cerita rakyat Pendalungan',
                'icon' => '📖',
                'kategori' => 'Lanjutan',
                'warna_kategori' => '#E74C3C',
                'jumlah_pelajaran' => 16,
                'durasi' => 4,
                'url_kelas' => '/kelas/sastra-cerita-rakyat',
                'status' => true,
                'urutan' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Bahasa Daerah Pendalungan',
                'deskripsi' => 'Pelajari bahasa dan dialek khas masyarakat Pendalungan',
                'icon' => '💬',
                'kategori' => 'Pemula',
                'warna_kategori' => '#FF8C42',
                'jumlah_pelajaran' => 20,
                'durasi' => 6,
                'url_kelas' => '/kelas/bahasa-daerah-pendalungan',
                'status' => true,
                'urutan' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Upacara Adat Pendalungan',
                'deskripsi' => 'Memahami makna dan prosesi upacara adat tradisional',
                'icon' => '⛩️',
                'kategori' => 'Menengah',
                'warna_kategori' => '#FF8C42',
                'jumlah_pelajaran' => 14,
                'durasi' => 5,
                'url_kelas' => '/kelas/upacara-adat-pendalungan',
                'status' => true,
                'urutan' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('kelas')->insert($kelas);
    }
}