<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Koleksi;

class KoleksiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Legenda Asal Mula Pendalungan',
                'kategori' => 'Naskah',
                'deskripsi' => 'Kisah cerita rakyat tentang asal-usul daerah Pendalungan',
                'penulis' => 'Tim Peneliti Budaya',
                'tahun' => 2023,
                'halaman' => 45,
                'durasi' => null,
                'jumlah_suka' => 1230,
                'jumlah_unduh' => 5680,
                'file_path' => 'koleksi/naskah1.pdf',
            ],
            [
                'judul' => "Lagu Tradisional 'Tanduk Majeng'",
                'kategori' => 'Lagu',
                'deskripsi' => 'Rekaman dan lirik lagu tradisional Pendalungan',
                'penulis' => 'Sanggar Seni Budaya',
                'tahun' => 2022,
                'halaman' => null,
                'durasi' => '4:32',
                'jumlah_suka' => 890,
                'jumlah_unduh' => 3420,
                'file_path' => 'koleksi/lagu1.mp3',
            ],
            [
                'judul' => 'Dokumenter Tari Jejer',
                'kategori' => 'Dokumentasi',
                'deskripsi' => 'Film dokumenter tentang tarian tradisional Jejer',
                'penulis' => 'Studio Dokumenter Nusantara',
                'tahun' => 2024,
                'halaman' => null,
                'durasi' => '28:15',
                'jumlah_suka' => 456,
                'jumlah_unduh' => 2100,
                'file_path' => 'koleksi/video1.mp4',
            ],
            [
                'judul' => 'Kumpulan Pantun Pendalungan',
                'kategori' => 'Naskah',
                'deskripsi' => 'Koleksi pantun dan syair tradisional daerah',
                'penulis' => 'Komunitas Sastra Lokal',
                'tahun' => 2023,
                'halaman' => 78,
                'durasi' => null,
                'jumlah_suka' => 670,
                'jumlah_unduh' => 2890,
                'file_path' => 'koleksi/naskah2.pdf',
            ],
            [
                'judul' => 'Tutorial Membatik Motif Pendalungan',
                'kategori' => 'Video',
                'deskripsi' => 'Panduan lengkap membuat batik dengan motif khas Pendalungan',
                'penulis' => 'Perajin Batik Tradisional',
                'tahun' => 2024,
                'halaman' => null,
                'durasi' => '45:22',
                'jumlah_suka' => 320,
                'jumlah_unduh' => 1560,
                'file_path' => 'koleksi/video2.mp4',
            ],
            [
                'judul' => 'Sejarah Kerajaan Pendalungan',
                'kategori' => 'Naskah',
                'deskripsi' => 'Penelitian mendalam tentang sejarah kerajaan dan budaya',
                'penulis' => 'Prof. Dr. Budiono Sastro',
                'tahun' => 2023,
                'halaman' => 156,
                'durasi' => null,
                'jumlah_suka' => 1100,
                'jumlah_unduh' => 4200,
                'file_path' => 'koleksi/naskah3.pdf',
            ],
        ];

        foreach ($data as $item) {
            Koleksi::create($item);
        }
    }
}