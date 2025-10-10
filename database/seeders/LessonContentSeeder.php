<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\bahasa\Lesson;
use App\Models\bahasa\LessonContent;

class LessonContentSeeder extends Seeder
{
    public function run()
    {
        // ============================================
        // BAGIAN 1: PEMBELAJARAN DASAR
        // ============================================

        // 1. PENGENALAN HURUF DAN SUARA
        $lesson1 = Lesson::where('title', 'Pengenalan Huruf dan Suara')->first();
        if ($lesson1) {
            $contents = [
                [
                    'word' => 'A',
                    'meaning' => 'Huruf vokal pertama',
                    'example' => 'Apel (Apple)',
                    'pronunciations' => [
                        ['text' => 'a()', 'sound' => 'ah'],
                        ['text' => 'a', 'sound' => 'a']
                    ],
                    'tip' => 'Huruf A dalam bahasa Madura diucapkan dengan jelas dan tegas',
                    'order' => 1,
                    'audiofile' => 'audio-phrases/jawa/A.mp3'
                ],
                [
                    'word' => 'E',
                    'meaning' => 'Huruf vokal kedua',
                    'example' => 'Embun (Dew)',
                    'pronunciations' => [
                        ['text' => 'é', 'sound' => 'e'],
                        ['text' => 'è', 'sound' => 'eh']
                    ],
                    'tip' => 'Ada dua jenis pengucapan E: é (seperti "keras") dan è (seperti "enak")',
                    'order' => 2
                ],
                [
                    'word' => 'I',
                    'meaning' => 'Huruf vokal ketiga',
                    'example' => 'Ikan (Fish)',
                    'pronunciations' => [
                        ['text' => 'i', 'sound' => 'i']
                    ],
                    'tip' => 'Huruf I diucapkan seperti dalam kata "ini"',
                    'order' => 3
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson1->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 2. KOSAKATA SEHARI-HARI
        $lesson2 = Lesson::where('title', 'Kosakata Sehari-hari')->first();
        if ($lesson2) {
            $contents = [
                [
                    'word' => 'Mangan',
                    'meaning' => 'Makan',
                    'example' => 'Ayo mangan bareng',
                    'pronunciations' => [
                        ['text' => 'ma-ngan', 'sound' => 'mangan']
                    ],
                    'tip' => 'Kata "mangan" sering digunakan dalam percakapan sehari-hari',
                    'order' => 1
                ],
                [
                    'word' => 'Ngombe',
                    'meaning' => 'Minum',
                    'example' => 'Ngombe es teh',
                    'pronunciations' => [
                        ['text' => 'ngo-mbe', 'sound' => 'ngombe']
                    ],
                    'tip' => 'Perhatikan pengucapan "ng" di awal kata',
                    'order' => 2
                ],
                [
                    'word' => 'Turu',
                    'meaning' => 'Tidur',
                    'example' => 'Waktuna turu',
                    'pronunciations' => [
                        ['text' => 'tu-ru', 'sound' => 'turu']
                    ],
                    'tip' => 'Kata sederhana yang mudah diingat untuk aktivitas tidur',
                    'order' => 3
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson2->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 3. ANGKA DAN WAKTU
        $lesson3 = Lesson::where('title', 'Angka dan Waktu')->first();
        if ($lesson3) {
            $contents = [
                [
                    'word' => 'Siji',
                    'meaning' => 'Satu (1)',
                    'example' => 'Siji apel',
                    'pronunciations' => [
                        ['text' => 'si-ji', 'sound' => 'siji']
                    ],
                    'tip' => 'Angka dasar pertama dalam bahasa Madura',
                    'order' => 1
                ],
                [
                    'word' => 'Loro',
                    'meaning' => 'Dua (2)',
                    'example' => 'Loro jeruk',
                    'pronunciations' => [
                        ['text' => 'lo-ro', 'sound' => 'loro']
                    ],
                    'tip' => 'Perhatikan pengucapan "ro" yang jelas',
                    'order' => 2
                ],
                [
                    'word' => 'Telu',
                    'meaning' => 'Tiga (3)',
                    'example' => 'Telu pisang',
                    'pronunciations' => [
                        ['text' => 'te-lu', 'sound' => 'telu']
                    ],
                    'tip' => 'Angka telu memiliki pengucapan yang unik',
                    'order' => 3
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson3->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 4. KELUARGA DAN PROFESI
        $lesson4 = Lesson::where('title', 'Keluarga dan Profesi')->first();
        if ($lesson4) {
            $contents = [
                [
                    'word' => 'Bapak',
                    'meaning' => 'Ayah',
                    'example' => 'Bapak lagi kerja',
                    'pronunciations' => [
                        ['text' => 'ba-pak', 'sound' => 'bapak']
                    ],
                    'tip' => 'Kata yang sangat penting untuk anggota keluarga',
                    'order' => 1
                ],
                [
                    'word' => 'Embu',
                    'meaning' => 'Ibu',
                    'example' => 'Embu lagi masak',
                    'pronunciations' => [
                        ['text' => 'em-bu', 'sound' => 'embu']
                    ],
                    'tip' => 'Kata "Embu" menunjukkan penghormatan kepada ibu',
                    'order' => 2
                ],
                [
                    'word' => 'Kaka',
                    'meaning' => 'Kakak',
                    'example' => 'Kaka beli jajan',
                    'pronunciations' => [
                        ['text' => 'ka-ka', 'sound' => 'kaka']
                    ],
                    'tip' => 'Digunakan untuk kakak laki-laki maupun perempuan',
                    'order' => 3
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson4->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // ============================================
        // BAGIAN 2: PERCAKAPAN PRAKTIS
        // ============================================

        // 5. BERBELANJA DI PASAR
        $lesson5 = Lesson::where('title', 'Berbelanja di Pasar')->first();
        if ($lesson5) {
            $contents = [
                [
                    'word' => 'Pèra ragina?',
                    'meaning' => 'Berapa harganya?',
                    'example' => 'Pèra ragina tomato sè kotak?',
                    'pronunciations' => [
                        ['text' => 'pè-ra ra-gi-na', 'sound' => 'pera-ragina']
                    ],
                    'tip' => 'Pertanyaan penting saat berbelanja di pasar tradisional',
                    'order' => 1
                ],
                [
                    'word' => 'Bisa kurang?',
                    'meaning' => 'Bisa kurang?',
                    'example' => 'Bisa kurang napa buk?',
                    'pronunciations' => [
                        ['text' => 'bi-sa ku-rang', 'sound' => 'bisa-kurang']
                    ],
                    'tip' => 'Tawar-menawar adalah hal yang wajar di pasar Madura',
                    'order' => 2
                ],
                [
                    'word' => 'Kalak sabun',
                    'meaning' => 'Mau beli',
                    'example' => 'Kalak sabun sèyur sapolo',
                    'pronunciations' => [
                        ['text' => 'ka-lak sa-bun', 'sound' => 'kalak-sabun']
                    ],
                    'tip' => 'Ungkapan untuk menyatakan niat membeli',
                    'order' => 3
                ],
                [
                    'word' => 'Sareng saè',
                    'meaning' => 'Yang bagus',
                    'example' => 'Pole sareng saè bèna',
                    'pronunciations' => [
                        ['text' => 'sa-reng sa-è', 'sound' => 'sareng-sae']
                    ],
                    'tip' => 'Gunakan untuk meminta barang berkualitas baik',
                    'order' => 4
                ],
                [
                    'word' => 'Taremma kaseya',
                    'meaning' => 'Terima kasih',
                    'example' => 'Taremma kaseya buk',
                    'pronunciations' => [
                        ['text' => 'ta-rem-ma ka-se-ya', 'sound' => 'taremma-kaseya']
                    ],
                    'tip' => 'Sopan santun penting dalam berbelanja',
                    'order' => 5
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson5->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 6. BERKENALAN DAN SAPA
        $lesson6 = Lesson::where('title', 'Berkenalan dan Sapa')->first();
        if ($lesson6) {
            $contents = [
                [
                    'word' => 'Apa kabar?',
                    'meaning' => 'Apa kabar?',
                    'example' => 'Apa kabar pak?',
                    'pronunciations' => [
                        ['text' => 'a-pa ka-bar', 'sound' => 'apa-kabar']
                    ],
                    'tip' => 'Sapaan umum untuk menanyakan kabar seseorang',
                    'order' => 1
                ],
                [
                    'word' => 'Asmana sampeyan?',
                    'meaning' => 'Siapa nama Anda?',
                    'example' => 'Asmana sampeyan sapa?',
                    'pronunciations' => [
                        ['text' => 'as-ma-na sam-pe-yan', 'sound' => 'asmana-sampeyan']
                    ],
                    'tip' => 'Cara sopan menanyakan nama dengan menggunakan "sampeyan"',
                    'order' => 2
                ],
                [
                    'word' => 'Asal dhari mana?',
                    'meaning' => 'Asal dari mana?',
                    'example' => 'Sampeyan asal dhari mana?',
                    'pronunciations' => [
                        ['text' => 'a-sal dha-ri ma-na', 'sound' => 'asal-dhari-mana']
                    ],
                    'tip' => 'Pertanyaan untuk mengenal lawan bicara lebih dekat',
                    'order' => 3
                ],
                [
                    'word' => 'Sèlamat pagè',
                    'meaning' => 'Selamat pagi',
                    'example' => 'Sèlamat pagè pak haji',
                    'pronunciations' => [
                        ['text' => 'sè-la-mat pa-gè', 'sound' => 'selamat-page']
                    ],
                    'tip' => 'Salam pagi yang sopan, biasa digunakan sampai jam 10 pagi',
                    'order' => 4
                ],
                [
                    'word' => 'Pangèra tèmmo',
                    'meaning' => 'Senang bertemu',
                    'example' => 'Pangèra tèmmo sareng sampeyan',
                    'pronunciations' => [
                        ['text' => 'pa-ngè-ra tèm-mo', 'sound' => 'pangera-temmo']
                    ],
                    'tip' => 'Ungkapan kegembiraan saat bertemu seseorang',
                    'order' => 5
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson6->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 7. MAKANAN DAN MINUMAN
        $lesson7 = Lesson::where('title', 'Makanan dan Minuman')->first();
        if ($lesson7) {
            $contents = [
                [
                    'word' => 'Kalak mangan',
                    'meaning' => 'Mau makan',
                    'example' => 'Kalak mangan soto madura',
                    'pronunciations' => [
                        ['text' => 'ka-lak ma-ngan', 'sound' => 'kalak-mangan']
                    ],
                    'tip' => 'Ungkapan untuk menyatakan keinginan makan',
                    'order' => 1
                ],
                [
                    'word' => 'Pedhes napa?',
                    'meaning' => 'Pedas tidak?',
                    'example' => 'Pedhes napa makananah?',
                    'pronunciations' => [
                        ['text' => 'pe-dhes na-pa', 'sound' => 'pedhes-napa']
                    ],
                    'tip' => 'Penting ditanyakan karena makanan Madura terkenal pedas',
                    'order' => 2
                ],
                [
                    'word' => 'Enggi laper',
                    'meaning' => 'Ya, lapar',
                    'example' => 'Enggi laper bânna',
                    'pronunciations' => [
                        ['text' => 'eng-gi la-per', 'sound' => 'enggi-laper']
                    ],
                    'tip' => 'Respon untuk menyatakan rasa lapar',
                    'order' => 3
                ],
                [
                    'word' => 'Ngombe tèh anget',
                    'meaning' => 'Minum teh hangat',
                    'example' => 'Kalak ngombe tèh anget',
                    'pronunciations' => [
                        ['text' => 'ngo-mbe tèh a-nget', 'sound' => 'ngombe-teh-anget']
                    ],
                    'tip' => 'Teh hangat adalah minuman favorit orang Madura',
                    'order' => 4
                ],
                [
                    'word' => 'Sèdep polan',
                    'meaning' => 'Enak sekali',
                    'example' => 'Sèdep polan makananah',
                    'pronunciations' => [
                        ['text' => 'sè-dep po-lan', 'sound' => 'sedep-polan']
                    ],
                    'tip' => 'Ungkapan pujian untuk makanan yang lezat',
                    'order' => 5
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson7->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 8. TANYA ARAH DAN TRANSPORTASI
        $lesson8 = Lesson::where('title', 'Tanya Arah dan Transportasi')->first();
        if ($lesson8) {
            $contents = [
                [
                    'word' => 'Dhe mana pasar?',
                    'meaning' => 'Di mana pasar?',
                    'example' => 'Dhe mana pasar dhari kèya?',
                    'pronunciations' => [
                        ['text' => 'dhe ma-na pa-sar', 'sound' => 'dhe-mana-pasar']
                    ],
                    'tip' => 'Pertanyaan dasar untuk menanyakan lokasi',
                    'order' => 1
                ],
                [
                    'word' => 'Jau napa?',
                    'meaning' => 'Jauh tidak?',
                    'example' => 'Jau napa dhari sèni?',
                    'pronunciations' => [
                        ['text' => 'ja-u na-pa', 'sound' => 'jau-napa']
                    ],
                    'tip' => 'Menanyakan jarak sebelum pergi ke suatu tempat',
                    'order' => 2
                ],
                [
                    'word' => 'Laju ka kanan',
                    'meaning' => 'Lurus ke kanan',
                    'example' => 'Laju ka kanan teros',
                    'pronunciations' => [
                        ['text' => 'la-ju ka ka-nan', 'sound' => 'laju-ka-kanan']
                    ],
                    'tip' => 'Petunjuk arah yang sering digunakan',
                    'order' => 3
                ],
                [
                    'word' => 'Naek apa?',
                    'meaning' => 'Naik apa?',
                    'example' => 'Naek apa ka kampong?',
                    'pronunciations' => [
                        ['text' => 'na-ek a-pa', 'sound' => 'naek-apa']
                    ],
                    'tip' => 'Menanyakan jenis transportasi yang digunakan',
                    'order' => 4
                ],
                [
                    'word' => 'Tolong tompah',
                    'meaning' => 'Tolong berhenti',
                    'example' => 'Tolong tompah dhari sèni pak',
                    'pronunciations' => [
                        ['text' => 'to-long tom-pah', 'sound' => 'tolong-tompah']
                    ],
                    'tip' => 'Digunakan saat naik angkutan umum dan ingin turun',
                    'order' => 5
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson8->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // ============================================
        // BAGIAN 3: BUDAYA DAN TRADISI
        // ============================================

        // 9. CERITA RAKYAT
        $lesson9 = Lesson::where('title', 'Cerita Rakyat')->first();
        if ($lesson9) {
            $contents = [
                [
                    'word' => 'Joko Tole',
                    'meaning' => 'Tokoh cerita rakyat Madura yang cerdik',
                    'example' => 'Carètana Joko Tole lakè tèrkenal',
                    'pronunciations' => [
                        ['text' => 'jo-ko to-le', 'sound' => 'joko-tole']
                    ],
                    'tip' => 'Joko Tole adalah tokoh legendaris yang terkenal dengan kecerdikannya',
                    'order' => 1
                ],
                [
                    'word' => 'Rato Èbu',
                    'meaning' => 'Ratu Ibu (tokoh cerita)',
                    'example' => 'Rato Èbu lakè sabar polo',
                    'pronunciations' => [
                        ['text' => 'ra-to è-bu', 'sound' => 'rato-ebu']
                    ],
                    'tip' => 'Tokoh penting dalam cerita rakyat Madura',
                    'order' => 2
                ],
                [
                    'word' => 'Carètana dhibi',
                    'meaning' => 'Cerita dulu',
                    'example' => 'Carètana dhibi lakè naèk',
                    'pronunciations' => [
                        ['text' => 'ca-rè-ta-na dhi-bi', 'sound' => 'caretana-dhibi']
                    ],
                    'tip' => 'Ungkapan pembuka untuk menceritakan cerita rakyat',
                    'order' => 3
                ],
                [
                    'word' => 'Bânto sè pènter',
                    'meaning' => 'Binatang yang pintar',
                    'example' => 'Bânto sè pènter lakè kancèl',
                    'pronunciations' => [
                        ['text' => 'bân-to sè pèn-ter', 'sound' => 'banto-se-penter']
                    ],
                    'tip' => 'Kancil sering muncul sebagai tokoh cerdik dalam cerita rakyat',
                    'order' => 4
                ],
                [
                    'word' => 'Pèssan dhari carèta',
                    'meaning' => 'Pesan dari cerita',
                    'example' => 'Pèssan dhari carèta lakè pènter',
                    'pronunciations' => [
                        ['text' => 'pès-san dha-ri ca-rè-ta', 'sound' => 'pessan-dhari-careta']
                    ],
                    'tip' => 'Setiap cerita rakyat memiliki nilai moral yang mendalam',
                    'order' => 5
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson9->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 10. PANTUN DAN PUISI
        $lesson10 = Lesson::where('title', 'Pantun dan Puisi')->first();
        if ($lesson10) {
            $contents = [
                [
                    'word' => 'Parèkan',
                    'meaning' => 'Pantun Madura',
                    'example' => 'Parèkan lakè budaya Madura',
                    'pronunciations' => [
                        ['text' => 'pa-rè-kan', 'sound' => 'parekan']
                    ],
                    'tip' => 'Parèkan adalah seni berpantun khas Madura yang sangat populer',
                    'order' => 1
                ],
                [
                    'word' => 'Tembang Madura',
                    'meaning' => 'Lagu tradisional Madura',
                    'example' => 'Tembang Madura lakè merdu',
                    'pronunciations' => [
                        ['text' => 'tem-bang ma-du-ra', 'sound' => 'tembang-madura']
                    ],
                    'tip' => 'Tembang biasanya dinyanyikan dalam acara-acara adat',
                    'order' => 2
                ],
                [
                    'word' => 'Sajak empat larik',
                    'meaning' => 'Puisi empat baris',
                    'example' => 'Sajak empat larik lakè gampang',
                    'pronunciations' => [
                        ['text' => 'sa-jak em-pat la-rik', 'sound' => 'sajak-empat-larik']
                    ],
                    'tip' => 'Struktur pantun Madura biasanya terdiri dari empat baris',
                    'order' => 3
                ],
                [
                    'word' => 'Sampiran',
                    'meaning' => 'Baris awal pantun',
                    'example' => 'Sampiran lakè dua larik awal',
                    'pronunciations' => [
                        ['text' => 'sam-pi-ran', 'sound' => 'sampiran']
                    ],
                    'tip' => 'Sampiran adalah dua baris pertama yang berisi kiasan',
                    'order' => 4
                ],
                [
                    'word' => 'Isi pantun',
                    'meaning' => 'Inti dari pantun',
                    'example' => 'Isi pantun lakè maksud sè èngko',
                    'pronunciations' => [
                        ['text' => 'i-si pan-tun', 'sound' => 'isi-pantun']
                    ],
                    'tip' => 'Dua baris terakhir berisi pesan atau maksud sebenarnya',
                    'order' => 5
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson10->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 11. PERCAKAPAN FORMAL
        $lesson11 = Lesson::where('title', 'Percakapan Formal')->first();
        if ($lesson11) {
            $contents = [
                [
                    'word' => 'Ngaturaghi panèka',
                    'meaning' => 'Mengucapkan terima kasih (formal)',
                    'example' => 'Ngaturaghi panèka ka sampeyan',
                    'pronunciations' => [
                        ['text' => 'nga-tu-ra-ghi pa-nè-ka', 'sound' => 'ngaturaghi-paneka']
                    ],
                    'tip' => 'Bentuk sangat formal dan sopan untuk mengucapkan terima kasih',
                    'order' => 1
                ],
                [
                    'word' => 'Kaolah pangampura',
                    'meaning' => 'Mohon maaf (formal)',
                    'example' => 'Kaolah pangampura bilang salah',
                    'pronunciations' => [
                        ['text' => 'ka-o-lah pa-ngam-pu-ra', 'sound' => 'kaolah-pangampura']
                    ],
                    'tip' => 'Digunakan dalam situasi formal atau kepada orang yang dihormati',
                    'order' => 2
                ],
                [
                    'word' => 'Pareng kaulah',
                    'meaning' => 'Izinkan saya',
                    'example' => 'Pareng kaulah badhe pamèt',
                    'pronunciations' => [
                        ['text' => 'pa-reng ka-u-lah', 'sound' => 'pareng-kaulah']
                    ],
                    'tip' => 'Ungkapan formal untuk meminta izin',
                    'order' => 3
                ],
                [
                    'word' => 'Paduka',
                    'meaning' => 'Anda (sangat formal)',
                    'example' => 'Paduka asal dhari mana?',
                    'pronunciations' => [
                        ['text' => 'pa-du-ka', 'sound' => 'paduka']
                    ],
                    'tip' => 'Kata ganti orang kedua yang sangat sopan dan formal',
                    'order' => 4
                ],
                [
                    'word' => 'Dhalem',
                    'meaning' => 'Saya (rendah diri/formal)',
                    'example' => 'Dhalem badhe ngatorragi',
                    'pronunciations' => [
                        ['text' => 'dha-lem', 'sound' => 'dhalem']
                    ],
                    'tip' => 'Kata ganti orang pertama yang menunjukkan kerendahan hati',
                    'order' => 5
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson11->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        // 12. UPACARA ADAT
        $lesson12 = Lesson::where('title', 'Upacara Adat')->first();
        if ($lesson12) {
            $contents = [
                [
                    'word' => 'Karapan sapi',
                    'meaning' => 'Perlombaan balap sapi',
                    'example' => 'Karapan sapi lakè tradisi Madura',
                    'pronunciations' => [
                        ['text' => 'ka-ra-pan sa-pi', 'sound' => 'karapan-sapi']
                    ],
                    'tip' => 'Karapan sapi adalah tradisi paling terkenal dari Madura',
                    'order' => 1
                ],
                [
                    'word' => 'Rongkang',
                    'meaning' => 'Upacara pernikahan adat',
                    'example' => 'Rongkang lakè upacara pènting',
                    'pronunciations' => [
                        ['text' => 'rong-kang', 'sound' => 'rongkang']
                    ],
                    'tip' => 'Prosesi adat dalam pernikahan Madura yang sakral',
                    'order' => 2
                ],
                [
                    'word' => 'Kèar angèn',
                    'meaning' => 'Upacara tolak bala',
                    'example' => 'Kèar angèn kanggo tolak bala',
                    'pronunciations' => [
                        ['text' => 'kè-ar a-ngèn', 'sound' => 'kear-angen']
                    ],
                    'tip' => 'Upacara tradisional untuk menolak malapetaka',
                    'order' => 3
                ],
                [
                    'word' => 'Nyabis',
                    'meaning' => 'Upacara syukuran',
                    'example' => 'Nyabis pas panen raya',
                    'pronunciations' => [
                        ['text' => 'nya-bis', 'sound' => 'nyabis']
                    ],
                    'tip' => 'Tradisi bersyukur atas hasil panen yang melimpah',
                    'order' => 4
                ],
                [
                    'word' => 'Rokat tase',
                    'meaning' => 'Upacara laut',
                    'example' => 'Rokat tase kanggo nelayan',
                    'pronunciations' => [
                        ['text' => 'ro-kat ta-se', 'sound' => 'rokat-tase']
                    ],
                    'tip' => 'Upacara adat nelayan untuk keselamatan dan hasil tangkapan',
                    'order' => 5
                ]
            ];

            foreach ($contents as $content) {
                LessonContent::create([
                    'lesson_id' => $lesson12->id,
                    'word' => $content['word'],
                    'meaning' => $content['meaning'],
                    'example' => $content['example'],
                    'pronunciations' => $content['pronunciations'],
                    'tip' => $content['tip'],
                    'order' => $content['order']
                ]);
            }
        }

        $this->command->info('Lesson contents (Basic, Practical Conversation & Culture) seeded successfully!');
    }
}
