<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karya;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KaryaSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan sudah ada user
        $users = User::all();
        
        if ($users->count() < 3) {
            // Buat user dummy jika belum ada
            $users = collect([
                User::create([
                    'name' => 'Sari Dewi',
                    'email' => 'sari@example.com',
                    'password' => bcrypt('password')
                ]),
                User::create([
                    'name' => 'Budi Kurniawan',
                    'email' => 'budi@example.com',
                    'password' => bcrypt('password')
                ]),
                User::create([
                    'name' => 'Rina Maharani',
                    'email' => 'rina@example.com',
                    'password' => bcrypt('password')
                ])
            ]);
        }

        $karyas = [
            [
                'title' => 'Kolaborasi Tari Jejer Modern',
                'description' => 'Interpretasi modern dari tarian tradisional Jejer dengan sentuhan kontemporer.',
                'category' => 'tari',
                'file_type' => 'video',
                'views' => 1250,
                'likes' => 89,
                'downloads' => 45,
                'is_featured' => true,
                'user_id' => $users->random()->id,
            ],
            [
                'title' => 'Dokumenter: Perajin Batik Pendalungan',
                'description' => 'Film dokumenter tentang kehidupan dan karya para perajin batik tradisional.',
                'category' => 'dokumenter',
                'file_type' => 'video',
                'views' => 2100,
                'likes' => 156,
                'downloads' => 78,
                'is_featured' => true,
                'user_id' => $users->random()->id,
            ],
            [
                'title' => 'Kumpulan Puisi: Rindu Kampung',
                'description' => 'Kumpulan puisi yang menggambarkan kerinduan terhadap kampung halaman dan budaya lokal.',
                'category' => 'puisi',
                'file_type' => 'document',
                'views' => 670,
                'likes' => 123,
                'downloads' => 45,
                'is_featured' => false,
                'user_id' => $users->random()->id,
            ],
            [
                'title' => 'Musik Fusion: Gamelan Digital',
                'description' => 'Perpaduan gamelan tradisional dengan sentuhan musik digital modern.',
                'category' => 'musik',
                'file_type' => 'audio',
                'views' => 1400,
                'likes' => 98,
                'downloads' => 234,
                'is_featured' => false,
                'user_id' => $users->random()->id,
            ],
            [
                'title' => 'Fotografi: Potret Kehidupan Nelayan',
                'description' => 'Dokumentasi visual kehidupan sehari-hari para nelayan yang melestarikan budaya Pendalungan.',
                'category' => 'fotografi',
                'file_type' => 'image',
                'views' => 780,
                'likes' => 54,
                'downloads' => 67,
                'is_featured' => false,
                'user_id' => $users->random()->id,
            ],
            [
                'title' => 'Kerajinan: Vas Bambu Kontemporer',
                'description' => 'Desain vas dari bambu dengan sentuhan modern untuk dekorasi rumah.',
                'category' => 'kerajinan',
                'file_type' => 'image',
                'views' => 420,
                'likes' => 34,
                'downloads' => 23,
                'is_featured' => false,
                'user_id' => $users->random()->id,
            ],
        ];

        foreach ($karyas as $karyaData) {
            $karya = Karya::create($karyaData);
            
            // Tambahkan kolaborator random (1-2 orang)
            $collaborators = $users->random(rand(1, 2))->pluck('id');
            $karya->collaborators()->attach($collaborators);
            
            // Tambahkan beberapa komentar dummy
            for ($i = 0; $i < rand(2, 5); $i++) {
                DB::table('karya_comments')->insert([
                    'karya_id' => $karya->id,
                    'user_id' => $users->random()->id,
                    'comment' => 'Karya yang sangat menginspirasi! Terus berkarya.',
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}