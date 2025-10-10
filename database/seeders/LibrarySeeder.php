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
                'title' => 'Kajian Komprehensif Identitas Kultural di Tapal Kuda',
                'description' => 'Buku monumental setebal 199 halaman ini merupakan hasil penelitian etnografis',
                'type' => 'naskah',
                'author' => 'Mochamad Ilham',
                'year' => 2024,
                'pages' => 45,
                'duration' => '796',
                'file_path' => 'files/pandalungan.pdf',
                'views' => 0,
                'downloads' => 0,
            ],
            [
                'title' => 'Ensiklopedia Budaya',
                'description' => 'Naskah klasik Jawa monumental dalam 12 jilid yang menjadi rujukan historis pertama ',
                'type' => 'Naskah',
                'author' => 'Tim Kerajaan Surakarta',
                'year' => 1814,
                'pages' => 221,
                'duration' => null,
                'file_path' => 'files/pandalungan.pdf',
                'views' => 0,
                'downloads' => 0,
            ],
            [
                'title' => 'Bausastra Jawa-Indonesia',
                'description' => 'Kamus komprehensif Jawa-Indonesia yang menjadi rujukan utama etimologi',
                'type' => 'Naskah',
                'author' => 'S. Prawiroatmodjo',
                'year' => 1989,
                'pages' => 221,
                'duration' => null,
                'file_path' => 'files/pandalungan.pdf',
                'views' => 0,
                'downloads' => 0,
            ],
            [
                'title' => 'Jember Fashion Carnaval',
                'description' => 'Buku mewah ukuran folio setebal 300 halaman yang mendokumentasikan evolusi JFC dari event lokal menjadi festival internasional',
                'type' => 'naskah',
                'author' => 'Komunitas Sastra Lokal',
                'year' => 2023,
                'pages' => 221,
                'duration' => null,
                'file_path' => 'files/pendalungan.pdf',
                'views' => 0,
                'downloads' => 0,
            ],
            [
                'title' => 'Tutorial Membatik Motif Pendalungan',
                'description' => 'Panduan lengkap membuat batik dengan motif khas Pendalungan',
                'type' => 'naskah',
                'author' => 'Perajin Batik Tradisional',
                'year' => 2024,
                'pages' => 221,
                'duration' => null,
                'file_path' => 'files/pandalungan.pdf',
                'views' => 0,
                'downloads' => 0,
            ],
            [
                'title' => 'Kentrung Djos',
                'description' => 'Monograf spesialis setebal 150 halaman yang menganalisis secara detail ',
                'type' => 'naskah',
                'author' => 'Dr. S. Imam Setyawan',
                'year' => 2021,
                'pages' => 221,
                'duration' => null,
                'file_path' => 'files/sejarah-kerajaan.pdf',
                'views' => 0,
                'downloads' => 0,
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