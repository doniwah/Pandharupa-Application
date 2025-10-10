<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karya;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryaSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama jika ada
        DB::table('karya_collaborators')->delete();
        Karya::query()->delete();

        // Pastikan sudah ada user
        $users = User::all();

        if ($users->isEmpty()) {
            // Buat user dummy jika belum ada
            $users = collect([
                User::create([
                    'name' => 'Sari Dewi',
                    'email' => 'sari@example.com',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]),
                User::create([
                    'name' => 'Budi Kurniawan',
                    'email' => 'budi@example.com',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]),
                User::create([
                    'name' => 'Rina Maharani',
                    'email' => 'rina@example.com',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ])
            ]);
        }

        $karyas = [
            [
                'title' => 'Kolaborasi Tari Jejer Modern',
                'description' => 'Interpretasi modern dari tarian tradisional Jejer dengan sentuhan kontemporer. Menampilkan gerakan tari yang dinamis dengan musik gamelan yang dipadukan dengan beat modern.',
                'category' => 'tari',
                'file_type' => 'video',
                'file_path' => 'video/tari_jejer_modern.mp4',
                'views' => 1250,
                'likes' => 89,
                'downloads' => 45,
                'is_featured' => true,
                'user_id' => $users->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Musik Fusion: Gamelan Digital',
                'description' => 'Perpaduan gamelan tradisional dengan sentuhan musik digital modern. Durasi 5 menit 24 detik. Menampilkan kolaborasi antara musisi gamelan dan DJ elektronik.',
                'category' => 'musik',
                'file_type' => 'audio',
                'file_path' => 'audio-phrases/kanya/audio/gamelan_digital.mp3',
                'views' => 1400,
                'likes' => 98,
                'downloads' => 234,
                'is_featured' => true,
                'user_id' => $users->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kumpulan Puisi: Rindu Kampung',
                'description' => 'Kumpulan puisi yang menggambarkan kerinduan terhadap kampung halaman dan budaya lokal. Berisi 25 puisi pilihan tentang kehidupan tradisional dan nostalgia.',
                'category' => 'puisi',
                'file_type' => 'document',
                'file_path' => 'document/puisi_rindu_kampung.pdf',
                'views' => 670,
                'likes' => 123,
                'downloads' => 45,
                'is_featured' => false,
                'user_id' => $users->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Fotografi: Potret Kehidupan Nelayan',
                'description' => 'Dokumentasi visual kehidupan sehari-hari para nelayan yang melestarikan budaya Pendalungan. Koleksi 20 foto yang menggambarkan aktivitas nelayan dari subuh hingga senja.',
                'category' => 'fotografi',
                'file_type' => 'pictures',
                'file_path' => 'pictures/potret_nelayan.png',
                'views' => 780,
                'likes' => 54,
                'downloads' => 67,
                'is_featured' => false,
                'user_id' => $users->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kerajinan: Vas Bambu Kontemporer',
                'description' => 'Desain vas dari bambu dengan sentuhan modern untuk dekorasi rumah. Memadukan teknik tradisional dengan estetika kontemporer.',
                'category' => 'kerajinan',
                'file_type' => 'pictures',
                'file_path' => 'pictures/vas_bambu.jpg',
                'views' => 420,
                'likes' => 34,
                'downloads' => 23,
                'is_featured' => false,
                'user_id' => $users->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dokumenter: Warisan Kuliner Tradisional',
                'description' => 'Film pendek tentang kuliner khas Pendalungan dan cerita di balik setiap hidangan. Menampilkan wawancara dengan chef tradisional.',
                'category' => 'dokumenter',
                'file_type' => 'video',
                'file_path' => 'video/dokumenter_kuliner.mp4',
                'views' => 1456,
                'likes' => 123,
                'downloads' => 67,
                'is_featured' => false,
                'user_id' => $users->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($karyas as $karyaData) {
            $karya = Karya::create($karyaData);

            // PERBAIKAN: Ambil jumlah kolaborator secara dinamis
            $availableUsers = $users->where('id', '!=', $karya->user_id); // Exclude pemilik karya
            $collaboratorCount = min(rand(1, 2), $availableUsers->count()); // Jangan minta lebih dari yang tersedia

            if ($collaboratorCount > 0) {
                $collaborators = $availableUsers->random($collaboratorCount)->pluck('id');
                $karya->collaborators()->attach($collaborators);
            }
        }
    }
}
