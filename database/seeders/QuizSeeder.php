<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\quiz\Quiz;
use App\Models\quiz\Question;
use App\Models\quiz\Achievements;
use App\Models\quiz\Leaderboard;
use App\Models\quiz\UserAchievement;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Create sample user for leaderboard
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Siti Aminah',
                'password' => Hash::make('password'),
            ]
        );

        // Quiz 1: Sejarah Budaya
        $quiz1 = Quiz::create([
            'title' => 'Sejarah Budaya',
            'description' => 'Uji pengetahuan tentang sejarah dan perkembangan budaya Pendalungan',
            'difficulty' => 'mudah',
            'icon' => 'bi bi-bank2',
            'question_count' => 5,
            'participant_count' => 456,
            'time_limit' => 10
        ]);

        Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'Apa nama tarian tradisional khas Banyuwangi yang menggunakan properti payung?',
            'option_a' => 'Tari Gandrung',
            'option_b' => 'Tari Seblang',
            'option_c' => 'Tari Jejer',
            'option_d' => 'Tari Angklung Caruk',
            'correct_answer' => 'a',
            'explanation' => 'Tari Gandrung adalah tarian tradisional khas Banyuwangi yang menggunakan properti payung.',
            'order' => 1
        ]);

        Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'Suku Osing merupakan penduduk asli dari daerah mana?',
            'option_a' => 'Banyuwangi',
            'option_b' => 'Surabaya',
            'option_c' => 'Malang',
            'option_d' => 'Jember',
            'correct_answer' => 'a',
            'explanation' => 'Suku Osing adalah penduduk asli Banyuwangi dan merupakan suku tertua di Jawa Timur.',
            'order' => 2
        ]);

        Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'Apa nama kerajaan Hindu-Buddha yang pernah berjaya di daerah Tapal Kuda?',
            'option_a' => 'Kerajaan Blambangan',
            'option_b' => 'Kerajaan Singhasari',
            'option_c' => 'Kerajaan Majapahit',
            'option_d' => 'Kerajaan Kanjuruhan',
            'correct_answer' => 'a',
            'explanation' => 'Kerajaan Blambangan adalah kerajaan Hindu-Buddha yang berjaya di wilayah Tapal Kuda.',
            'order' => 3
        ]);

        Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'Kapan Kabupaten Banyuwangi resmi berdiri?',
            'option_a' => '18 Desember 1771',
            'option_b' => '20 Mei 1780',
            'option_c' => '15 Agustus 1765',
            'option_d' => '10 November 1775',
            'correct_answer' => 'a',
            'explanation' => 'Kabupaten Banyuwangi resmi berdiri pada 18 Desember 1771.',
            'order' => 4
        ]);

        Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'Apa nama pelabuhan kuno di Banyuwangi yang menjadi pusat perdagangan?',
            'option_a' => 'Pelabuhan Boom',
            'option_b' => 'Pelabuhan Tanjung Wangi',
            'option_c' => 'Pelabuhan Muncar',
            'option_d' => 'Pelabuhan Ketapang',
            'correct_answer' => 'd',
            'explanation' => 'Pelabuhan Ketapang adalah pelabuhan kuno yang menjadi pusat perdagangan di Banyuwangi.',
            'order' => 5
        ]);

        // Quiz 2: Bahasa Daerah
        $quiz2 = Quiz::create([
            'title' => 'Bahasa Daerah',
            'description' => 'Quiz tentang tata bahasa Madura, Jawa, dan Osing',
            'difficulty' => 'sedang',
            'icon' => 'bi bi-chat-dots',
            'question_count' => 6,
            'participant_count' => 389,
            'time_limit' => 15
        ]);

        Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Apa arti kata "reya" dalam bahasa Osing?',
            'option_a' => 'Besar',
            'option_b' => 'Banyak',
            'option_c' => 'Indah',
            'option_d' => 'Cepat',
            'correct_answer' => 'b',
            'explanation' => 'Kata "reya" dalam bahasa Osing berarti "banyak".',
            'order' => 1
        ]);

        Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Bagaimana mengatakan "saya mau makan" dalam bahasa Madura?',
            'option_a' => 'Kula badhe nedha',
            'option_b' => 'Isun arema ngeda',
            'option_c' => 'Aku arek mangan',
            'option_d' => 'Abdi badhe tuang',
            'correct_answer' => 'b',
            'explanation' => '"Isun arema ngeda" adalah cara mengatakan "saya mau makan" dalam bahasa Madura.',
            'order' => 2
        ]);

        Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Apa perbedaan bahasa Jawa "ngoko" dan "krama"?',
            'option_a' => 'Dialek daerah',
            'option_b' => 'Tingkat kesopanan',
            'option_c' => 'Jenis kelamin pembicara',
            'option_d' => 'Usia pembicara',
            'correct_answer' => 'b',
            'explanation' => 'Ngoko digunakan untuk teman sebaya, krama untuk yang lebih tua atau dihormati.',
            'order' => 3
        ]);

        Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Kata "pokol" dalam bahasa Osing berarti?',
            'option_a' => 'Pukul',
            'option_b' => 'Pergi',
            'option_c' => 'Panggil',
            'option_d' => 'Potong',
            'correct_answer' => 'a',
            'explanation' => '"Pokol" dalam bahasa Osing berarti "pukul".',
            'order' => 4
        ]);

        Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Bahasa Osing memiliki pengaruh kuat dari bahasa...',
            'option_a' => 'Jawa Kuno',
            'option_b' => 'Sanskerta',
            'option_c' => 'Melayu',
            'option_d' => 'Belanda',
            'correct_answer' => 'a',
            'explanation' => 'Bahasa Osing memiliki pengaruh kuat dari bahasa Jawa Kuno.',
            'order' => 5
        ]);

        Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Apa arti "lare" dalam bahasa Madura?',
            'option_a' => 'Laut',
            'option_b' => 'Anak',
            'option_c' => 'Besar',
            'option_d' => 'Jauh',
            'correct_answer' => 'b',
            'explanation' => '"Lare" dalam bahasa Madura berarti "anak".',
            'order' => 6
        ]);

        // Quiz 3: Seni & Kerajinan
        $quiz3 = Quiz::create([
            'title' => 'Seni & Kerajinan',
            'description' => 'Pelajari seni dan budaya tradisional dan kerajinan tangan',
            'difficulty' => 'sedang',
            'icon' => 'bi bi-palette',
            'question_count' => 5,
            'participant_count' => 312,
            'time_limit' => 12
        ]);

        Question::create([
            'quiz_id' => $quiz3->id,
            'question_text' => 'Apa nama kain tenun khas Banyuwangi?',
            'option_a' => 'Batik Gajah Oling',
            'option_b' => 'Tenun Ikat Troso',
            'option_c' => 'Kain Lurik',
            'option_d' => 'Batik Tulis',
            'correct_answer' => 'a',
            'explanation' => 'Batik Gajah Oling adalah motif batik khas Banyuwangi.',
            'order' => 1
        ]);

        Question::create([
            'quiz_id' => $quiz3->id,
            'question_text' => 'Kerajinan anyaman dari daun lontar banyak diproduksi di daerah mana?',
            'option_a' => 'Jember',
            'option_b' => 'Lumajang',
            'option_c' => 'Banyuwangi',
            'option_d' => 'Situbondo',
            'correct_answer' => 'c',
            'explanation' => 'Kerajinan anyaman daun lontar banyak diproduksi di Banyuwangi.',
            'order' => 2
        ]);

        Question::create([
            'quiz_id' => $quiz3->id,
            'question_text' => 'Apa nama seni ukir khas Madura?',
            'option_a' => 'Ukir Jepara',
            'option_b' => 'Ukir Madura',
            'option_c' => 'Ukir Pamekasan',
            'option_d' => 'Ukir Tanjung Bumi',
            'correct_answer' => 'd',
            'explanation' => 'Ukir Tanjung Bumi adalah seni ukir khas Madura.',
            'order' => 3
        ]);

        Question::create([
            'quiz_id' => $quiz3->id,
            'question_text' => 'Bahan utama pembuatan kerajinan gerabah di Jember adalah?',
            'option_a' => 'Tanah liat merah',
            'option_b' => 'Tanah liat putih',
            'option_c' => 'Pasir laut',
            'option_d' => 'Batu kapur',
            'correct_answer' => 'a',
            'explanation' => 'Tanah liat merah adalah bahan utama pembuatan gerabah di Jember.',
            'order' => 4
        ]);

        Question::create([
            'quiz_id' => $quiz3->id,
            'question_text' => 'Apa motif batik yang menjadi ciri khas Pendalungan?',
            'option_a' => 'Motif campuran Jawa-Madura',
            'option_b' => 'Motif wayang',
            'option_c' => 'Motif flora fauna',
            'option_d' => 'Motif geometris',
            'correct_answer' => 'a',
            'explanation' => 'Motif batik Pendalungan merupakan perpaduan motif Jawa dan Madura.',
            'order' => 5
        ]);

        // Quiz 4: Kuliner Tradisional
        $quiz4 = Quiz::create([
            'title' => 'Kuliner Tradisional',
            'description' => 'Seberapa kenal kamu dengan makanan khas Pendalungan?',
            'difficulty' => 'mudah',
            'icon' => 'bi bi-egg-fried',
            'question_count' => 5,
            'participant_count' => 523,
            'time_limit' => 8
        ]);

        Question::create([
            'quiz_id' => $quiz4->id,
            'question_text' => 'Apa nama makanan khas Banyuwangi berupa sate daging yang dibakar?',
            'option_a' => 'Sate Kelinci',
            'option_b' => 'Sate Maranggi',
            'option_c' => 'Sate Buntel',
            'option_d' => 'Sate Kambing',
            'correct_answer' => 'b',
            'explanation' => 'Sate Maranggi adalah sate daging khas Banyuwangi.',
            'order' => 1
        ]);

        Question::create([
            'quiz_id' => $quiz4->id,
            'question_text' => 'Rujak dengan bumbu petis khas Jawa Timur disebut?',
            'option_a' => 'Rujak Cingur',
            'option_b' => 'Rujak Soto',
            'option_c' => 'Rujak Petis',
            'option_d' => 'Rujak Banyuwangi',
            'correct_answer' => 'a',
            'explanation' => 'Rujak Cingur adalah rujak dengan bumbu petis khas Jawa Timur.',
            'order' => 2
        ]);

        Question::create([
            'quiz_id' => $quiz4->id,
            'question_text' => 'Makanan khas Madura dari daging ayam atau bebek yang dibumbui kuat adalah?',
            'option_a' => 'Ayam Betutu',
            'option_b' => 'Bebek Sinjay',
            'option_c' => 'Ayam Taliwang',
            'option_d' => 'Bebek Madura',
            'correct_answer' => 'b',
            'explanation' => 'Bebek Sinjay adalah makanan khas Madura.',
            'order' => 3
        ]);

        Question::create([
            'quiz_id' => $quiz4->id,
            'question_text' => 'Apa nama minuman tradisional khas Pendalungan dari jahe dan santan?',
            'option_a' => 'Wedang Ronde',
            'option_b' => 'Wedang Jahe',
            'option_c' => 'Wedang Cor',
            'option_d' => 'Bajigur',
            'correct_answer' => 'd',
            'explanation' => 'Bajigur adalah minuman tradisional dari jahe dan santan.',
            'order' => 4
        ]);

        Question::create([
            'quiz_id' => $quiz4->id,
            'question_text' => 'Makanan khas Jember dari tape singkong yang digoreng disebut?',
            'option_a' => 'Getuk',
            'option_b' => 'Tape Goreng',
            'option_c' => 'Klenyem',
            'option_d' => 'Combro',
            'correct_answer' => 'b',
            'explanation' => 'Tape Goreng adalah makanan khas Jember.',
            'order' => 5
        ]);

        // Quiz 5: Tarian & Musik
        $quiz5 = Quiz::create([
            'title' => 'Tarian & Musik',
            'description' => 'Quiz tentang tarian tradisional dan alat musik daerah',
            'difficulty' => 'sulit',
            'icon' => 'bi bi-music-note-beamed',
            'question_count' => 6,
            'participant_count' => 267,
            'time_limit' => 18
        ]);

        Question::create([
            'quiz_id' => $quiz5->id,
            'question_text' => 'Apa nama alat musik pukul khas Banyuwangi dari bambu?',
            'option_a' => 'Angklung',
            'option_b' => 'Gamelan',
            'option_c' => 'Kendang',
            'option_d' => 'Gambang',
            'correct_answer' => 'a',
            'explanation' => 'Angklung adalah alat musik pukul dari bambu khas Banyuwangi.',
            'order' => 1
        ]);

        Question::create([
            'quiz_id' => $quiz5->id,
            'question_text' => 'Tari Seblang biasanya dipentaskan untuk acara apa?',
            'option_a' => 'Pernikahan',
            'option_b' => 'Panen raya',
            'option_c' => 'Tolak bala',
            'option_d' => 'Syukuran',
            'correct_answer' => 'c',
            'explanation' => 'Tari Seblang dipentaskan untuk ritual tolak bala.',
            'order' => 2
        ]);

        Question::create([
            'quiz_id' => $quiz5->id,
            'question_text' => 'Apa nama musik tradisional khas Madura?',
            'option_a' => 'Saronen',
            'option_b' => 'Gamelan',
            'option_c' => 'Calung',
            'option_d' => 'Keroncong',
            'correct_answer' => 'a',
            'explanation' => 'Saronen adalah musik tradisional khas Madura.',
            'order' => 3
        ]);

        Question::create([
            'quiz_id' => $quiz5->id,
            'question_text' => 'Berapa jumlah penari utama dalam Tari Gandrung?',
            'option_a' => '1 orang',
            'option_b' => '2 orang',
            'option_c' => '4 orang',
            'option_d' => '8 orang',
            'correct_answer' => 'b',
            'explanation' => 'Tari Gandrung biasanya dimainkan oleh 2 penari utama.',
            'order' => 4
        ]);

        Question::create([
            'quiz_id' => $quiz5->id,
            'question_text' => 'Apa nama tarian perang khas Osing?',
            'option_a' => 'Tari Barong',
            'option_b' => 'Tari Kuntulan',
            'option_c' => 'Tari Jaranan',
            'option_d' => 'Tari Padhang Ulan',
            'correct_answer' => 'd',
            'explanation' => 'Tari Padhang Ulan adalah tarian perang khas Osing.',
            'order' => 5
        ]);

        Question::create([
            'quiz_id' => $quiz5->id,
            'question_text' => 'Alat musik Saronen terbuat dari bahan apa?',
            'option_a' => 'Bambu',
            'option_b' => 'Kayu',
            'option_c' => 'Logam',
            'option_d' => 'Tanah liat',
            'correct_answer' => 'b',
            'explanation' => 'Saronen terbuat dari kayu dengan membran dari kulit hewan.',
            'order' => 6
        ]);

        // Quiz 6: Upacara Adat
        $quiz6 = Quiz::create([
            'title' => 'Upacara Adat',
            'description' => 'Tradisi dan upacara adat yang masih dilaksanakan',
            'difficulty' => 'sulit',
            'icon' => 'bi bi-fire',
            'question_count' => 5,
            'participant_count' => 198,
            'time_limit' => 15
        ]);

        Question::create([
            'quiz_id' => $quiz6->id,
            'question_text' => 'Upacara adat kebo-keboan dilaksanakan di daerah mana?',
            'option_a' => 'Banyuwangi',
            'option_b' => 'Jember',
            'option_c' => 'Lumajang',
            'option_d' => 'Probolinggo',
            'correct_answer' => 'a',
            'explanation' => 'Upacara kebo-keboan dilaksanakan di Banyuwangi.',
            'order' => 1
        ]);

        Question::create([
            'quiz_id' => $quiz6->id,
            'question_text' => 'Apa tujuan upacara petik laut di Muncar?',
            'option_a' => 'Meminta hujan',
            'option_b' => 'Syukuran hasil laut',
            'option_c' => 'Tolak bala',
            'option_d' => 'Menyambut panen',
            'correct_answer' => 'b',
            'explanation' => 'Petik laut adalah upacara syukuran hasil laut.',
            'order' => 2
        ]);

        Question::create([
            'quiz_id' => $quiz6->id,
            'question_text' => 'Upacara seblang biasanya dilaksanakan pada bulan apa?',
            'option_a' => 'Suro',
            'option_b' => 'Maulud',
            'option_c' => 'Poso',
            'option_d' => 'Besar',
            'correct_answer' => 'a',
            'explanation' => 'Upacara seblang dilaksanakan pada bulan Suro.',
            'order' => 3
        ]);

        Question::create([
            'quiz_id' => $quiz6->id,
            'question_text' => 'Apa nama upacara adat pernikahan khas Madura?',
            'option_a' => 'Ngerik',
            'option_b' => 'Ngalap berkah',
            'option_c' => 'Nanggap',
            'option_d' => 'Ngarot',
            'correct_answer' => 'a',
            'explanation' => 'Ngerik adalah upacara adat pernikahan khas Madura.',
            'order' => 4
        ]);

        Question::create([
            'quiz_id' => $quiz6->id,
            'question_text' => 'Upacara baritan adalah tradisi tolak bala dengan cara?',
            'option_a' => 'Membakar kemenyan',
            'option_b' => 'Mengelilingi kampung',
            'option_c' => 'Menanam kepala kerbau',
            'option_d' => 'Membuang sesaji ke laut',
            'correct_answer' => 'b',
            'explanation' => 'Baritan adalah tradisi mengelilingi kampung untuk tolak bala.',
            'order' => 5
        ]);

        // Create Achievements
$achievements = [
            [
                'name' => 'Pemula Budaya',
                'description' => 'Selesaikan 1 quiz',
                'icon' => 'bi bi-star',
                'type' => 'quiz_completed',
                'target' => 1,
                'points' => 10,
                'is_active' => true
            ],
            [
                'name' => 'Penjelajah Budaya',
                'description' => 'Selesaikan 5 quiz',
                'icon' => 'bi bi-compass',
                'type' => 'quiz_completed',
                'target' => 5,
                'points' => 50,
                'is_active' => true
            ],
            [
                'name' => 'Master Budaya',
                'description' => 'Selesaikan 10 quiz',
                'icon' => 'bi bi-trophy',
                'type' => 'quiz_completed',
                'target' => 10,
                'points' => 100,
                'is_active' => true
            ],
            [
                'name' => 'Sempurna',
                'description' => 'Dapatkan nilai 100% sebanyak 3 kali',
                'icon' => 'bi bi-check-circle',
                'type' => 'perfect_score',
                'target' => 3,
                'points' => 75,
                'is_active' => true
            ],
            [
                'name' => 'Ahli Jawaban',
                'description' => 'Jawab 100 pertanyaan dengan benar',
                'icon' => 'bi bi-lightning',
                'type' => 'correct_answers',
                'target' => 100,
                'points' => 150,
                'is_active' => true
            ],
            [
                'name' => 'Konsisten',
                'description' => 'Selesaikan quiz 7 hari berturut-turut',
                'icon' => 'bi bi-calendar-check',
                'type' => 'streak',
                'target' => 7,
                'points' => 200,
                'is_active' => true
            ]
        ];

        foreach ($achievements as $achievement) {
            Achievements::updateOrCreate(
                ['name' => $achievement['name']],
                $achievement
            );
        }

foreach ($achievements as $achievement) {
    Achievements::create($achievement);
}

        // Create sample leaderboard entry
        Leaderboard::create([
            'user_id' => $user->id,
            'total_score' => 9850,
            'quizzes_completed' => 15,
            'correct_answers' => 245,
            'level' => 'master'
        ]);

        $this->command->info('Quiz seeder berhasil dijalankan!');
        $this->command->info('Total quiz: ' . Quiz::count());
        $this->command->info('Total pertanyaan: ' . Question::count());
        $this->command->info('Total achievements: ' . Achievements::count());
    }
}
