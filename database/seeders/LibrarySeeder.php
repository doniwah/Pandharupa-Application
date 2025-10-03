<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrarySeeder extends Seeder
{
    public function run(): void
    {
        $libraries = [
            [
                'title' => 'Legenda Asal Mula Pendalungan',
                'description' => 'Koleksi cerita rakyat tentang asal-usul daerah Pendalungan',
                'type' => 'naskah',
                'author' => 'Tim Peneliti Budaya',
                'year' => 2023,
                'pages' => 45,
                'duration' => null,
                'file_path' => 'files/legenda-asal-mula.pdf',
                'views' => 5681,
                'downloads' => 1230,
            ],
            [
                'title' => 'Lagu Tradisional \'Tanduk Majeng\'',
                'description' => 'Rekaman dan lirik lagu tradisional Pendalungan',
                'type' => 'lagu',
                'author' => 'Sanggar Seni Budaya',
                'year' => 2022,
                'pages' => null,
                'duration' => '4:32',
                'file_path' => 'files/tanduk-majeng.mp3',
                'views' => 3421,
                'downloads' => 890,
            ],
            [
                'title' => 'Dokumenter Tari Jejer',
                'description' => 'Film dokumenter tentang tarian tradisional Jejer',
                'type' => 'dokumentasi',
                'author' => 'Studio Dokumenter Nusantara',
                'year' => 2024,
                'pages' => null,
                'duration' => '28:15',
                'file_path' => 'files/tari-jejer.mp4',
                'views' => 2100,
                'downloads' => 456,
            ],
            [
                'title' => 'Kumpulan Pantun Pendalungan',
                'description' => 'Koleksi pantun dan syair tradisional daerah budaya',
                'type' => 'naskah',
                'author' => 'Komunitas Sastra Lokal',
                'year' => 2023,
                'pages' => 78,
                'duration' => null,
                'file_path' => 'files/pantun-pendalungan.pdf',
                'views' => 2890,
                'downloads' => 670,
            ],
            [
                'title' => 'Tutorial Membatik Motif Pendalungan',
                'description' => 'Panduan lengkap membuat batik dengan motif khas Pendalungan',
                'type' => 'video',
                'author' => 'Perajin Batik Tradisional',
                'year' => 2024,
                'pages' => null,
                'duration' => '45:22',
                'file_path' => 'files/tutorial-batik.mp4',
                'views' => 1560,
                'downloads' => 320,
            ],
            [
                'title' => 'Sejarah Kerajaan Pendalungan',
                'description' => 'Penelitian mendalam tentang sejarah kerajaan dan budaya',
                'type' => 'naskah',
                'author' => 'Prof. Dr. Budiono Sastro',
                'year' => 2023,
                'pages' => 156,
                'duration' => null,
                'file_path' => 'files/sejarah-kerajaan.pdf',
                'views' => 4200,
                'downloads' => 1100,
            ],
            [
                'title' => 'Gamelan Pendalungan',
                'description' => 'Rekaman musik gamelan khas Pendalungan',
                'type' => 'audio',
                'author' => 'Paguyuban Karawitan',
                'year' => 2023,
                'pages' => null,
                'duration' => '15:40',
                'file_path' => 'files/gamelan.mp3',
                'views' => 1890,
                'downloads' => 445,
            ],
            [
                'title' => 'Upacara Adat Pendalungan',
                'description' => 'Dokumentasi lengkap upacara adat tradisional',
                'type' => 'video',
                'author' => 'Lembaga Adat Daerah',
                'year' => 2024,
                'pages' => null,
                'duration' => '52:18',
                'file_path' => 'files/upacara-adat.mp4',
                'views' => 2670,
                'downloads' => 589,
            ],
            [
                'title' => 'Kuliner Tradisional Pendalungan',
                'description' => 'Resep dan cerita di balik kuliner khas Pendalungan',
                'type' => 'naskah',
                'author' => 'Chef Nusantara Heritage',
                'year' => 2024,
                'pages' => 92,
                'duration' => null,
                'file_path' => 'files/kuliner-tradisional.pdf',
                'views' => 3120,
                'downloads' => 780,
            ],
        ];

        foreach ($libraries as $library) {
            DB::table('libraries')->insert(array_merge($library, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}