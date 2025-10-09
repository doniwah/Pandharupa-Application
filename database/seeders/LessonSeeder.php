<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\bahasa\Lesson;
use App\Models\bahasa\Language;

class LessonSeeder extends Seeder
{
    public function run()
    {
        // Seeder untuk Bahasa Jawa
        $jawa = Language::where('name', 'Bahasa Jawa')->first();

        $lessonsJawa = [
            ['title' => 'Pengenalan Aksara Jawa', 'content' => $this->getAksaraContent(), 'level' => 'pemula', 'order' => 1],
            ['title' => 'Percakapan Sehari-hari', 'content' => $this->getPercakapanContent(), 'level' => 'pemula', 'order' => 2],
            ['title' => 'Tingkat Tutur Ngoko', 'content' => $this->getNgokoContent(), 'level' => 'pemula', 'order' => 3],
            ['title' => 'Tingkat Tutur Krama', 'content' => $this->getKramaContent(), 'level' => 'pemula', 'order' => 4],
        ];

        foreach ($lessonsJawa as $data) {
            Lesson::create([
                'language_id' => $jawa->id,
                'title' => $data['title'],
                'content' => $data['content'],
                'level' => $data['level'],
                'order' => $data['order']
            ]);
        }

        // Seeder untuk Bahasa Madura
        $madura = Language::where('name', 'Bahasa Madura')->first();

        $lessonsMadura = [
            ['title' => 'Angka 1-100', 'content' => $this->getAngkaContent(), 'level' => 'pemula', 'order' => 1],
            ['title' => 'Kosakata Keluarga', 'content' => $this->getKeluargaContent(), 'level' => 'pemula', 'order' => 2],
            ['title' => 'Pengenalan Huruf Madura', 'content' => $this->getHurufContent(), 'level' => 'pemula', 'order' => 3],
            ['title' => 'Sapaan dan Perkenalan', 'content' => $this->getSapaanContent(), 'level' => 'pemula', 'order' => 4],
        ];

        foreach ($lessonsMadura as $data) {
            Lesson::create([
                'language_id' => $madura->id,
                'title' => $data['title'],
                'content' => $data['content'],
                'level' => $data['level'],
                'order' => $data['order']
            ]);
        }

        $osing = Language::where('name', 'Bahasa Osing')->first();

        $lessonsOsing = [
            ['title' => 'Kosakata Dasar', 'content' => $this->getKosakataDasarOsing(), 'level' => 'pemula', 'order' => 1],
            ['title' => 'Lagu dan Pantun Osing', 'content' => $this->getLaguPantunOsing(), 'level' => 'pemula', 'order' => 2],
            ['title' => 'Pengenalan Bahasa Osing', 'content' => $this->getPengenalanOsing(), 'level' => 'pemula', 'order' => 3],
            ['title' => 'Percakapan Dasar', 'content' => $this->getPercakapanOsing(), 'level' => 'pemula', 'order' => 4],
        ];

        foreach ($lessonsOsing as $data) {
            Lesson::create([
                'language_id' => $osing->id,
                'title' => $data['title'],
                'content' => $data['content'],
                'level' => $data['level'],
                'order' => $data['order']
            ]);
        }
    }

    // Content untuk Bahasa Jawa
    private function getAksaraContent()
    {
        return '
            <h2>Sejarah Aksara Jawa</h2>
            <p class="section-text-detail-bahasa">
                Aksara Jawa adalah salah satu warisan budaya yang sangat berharga dari tanah Jawa.
                Sistem tulisan ini telah digunakan selama berabad-abad untuk menulis bahasa Jawa dan
                bahasa-bahasa lainnya di Nusantara.
            </p>

            <h2>Huruf Dasar</h2>
            <p class="section-text-detail-bahasa">
                Aksara Jawa memiliki 20 huruf dasar yang disebut dengan Aksara Carakan:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ha</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Huruf pertama dalam Aksara Jawa</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Na</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Huruf kedua dalam Aksara Jawa</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ca</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Huruf ketiga dalam Aksara Jawa</div>
            </div>

            <h2>Cara Menulis</h2>
            <p class="section-text-detail-bahasa">
                Penulisan Aksara Jawa memiliki aturan khusus. Setiap huruf memiliki bentuk dasar yang
                dapat dimodifikasi dengan sandhangan (tanda diakritik) untuk mengubah bunyi vokal atau
                menambahkan konsonan.
            </p>
        ';
    }

    private function getPercakapanContent()
    {
        return '
            <h2>Salam dan Sapaan</h2>
            <p class="section-text-detail-bahasa">
                Memahami cara menyapa dan memberi salam dalam bahasa Jawa:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sugeng enjing</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Selamat pagi</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sugeng siang</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Selamat siang</div>
            </div>

            <h2>Ungkapan Umum</h2>
            <p class="section-text-detail-bahasa">
                Beberapa ungkapan yang sering digunakan dalam percakapan sehari-hari:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Matur nuwun</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Terima kasih</div>
            </div>
        ';
    }

    private function getNgokoContent()
    {
        return '
            <h2>Pengertian Ngoko</h2>
            <p class="section-text-detail-bahasa">
                Tingkat tutur Ngoko adalah tingkat bahasa Jawa yang paling santai dan informal.
                Digunakan dalam percakapan sehari-hari dengan teman sebaya atau orang yang lebih muda.
            </p>

            <h2>Ciri-ciri Bahasa Ngoko</h2>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Informal</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Digunakan dalam situasi santai</div>
            </div>
        ';
    }

    private function getKramaContent()
    {
        return '
            <h2>Pengertian Krama</h2>
            <p class="section-text-detail-bahasa">
                Tingkat tutur Krama adalah tingkat bahasa Jawa yang lebih halus dan sopan.
                Digunakan untuk berbicara dengan orang yang lebih tua atau dalam situasi formal.
            </p>

            <h2>Jenis-jenis Krama</h2>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Krama Inggil</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Tingkat paling tinggi dan sangat hormat</div>
            </div>
        ';
    }

    // Content untuk Bahasa Madura
    private function getAngkaContent()
    {
        return '
            <h1>Angka 1-100</h1>

            <p class="intro-text-detail-bahasa">
                Menguasai sistem bilangan dalam Bahasa Madura dari 1 hingga 100.
            </p>

            <div class="divider-detail-bahasa"></div>

            <h2>Angka 1-10</h2>

            <p class="section-text-detail-bahasa">
                Angka dasar yang paling sering digunakan:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Settong</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">1</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Dhuwa\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">2</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Tello\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">3</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Empa\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">4</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Lema\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">5</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ennem</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">6</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Petto\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">7</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Balu\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">8</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sanga\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">9</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sapolo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">10</div>
            </div>

            <h2>Angka 11-20</h2>

            <p class="section-text-detail-bahasa">
                Lanjutan angka belasan:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sapolo settong</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">11</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sapolo dhuwa\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">12</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sapolo tello\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">13</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sapolo lema\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">15</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Dua polo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">20</div>
            </div>

            <h2>Angka Puluhan</h2>

            <p class="section-text-detail-bahasa">
                Kelipatan sepuluh hingga seratus:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Tello\' polo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">30</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Empa\' polo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">40</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Lema\' polo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">50</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ennem polo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">60</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Petto\' polo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">70</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Balu\' polo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">80</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sanga\' polo</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">90</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Saratos</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">100</div>
            </div>

            <h2>Latihan Kombinasi</h2>

            <p class="section-text-detail-bahasa">
                Contoh kombinasi angka:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Dua polo lema\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">25</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Tello\' polo petto\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">37</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Lema\' polo ennem</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">56</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Balu\' polo sanga\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">89</div>
            </div>
        ';
    }

    private function getKeluargaContent()
    {
        return '
            <h1>Kosakata Keluarga</h1>

            <p class="intro-text-detail-bahasa">
                Pelajari sebutan untuk anggota keluarga dalam tingkat bahasa biasa dan halus.
            </p>

            <div class="divider-detail-bahasa"></div>

            <h2>Orang Tua (Tingkat Biasa)</h2>

            <p class="section-text-detail-bahasa">
                Panggilan informal untuk orang tua:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Eppa\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Ayah (informal)</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Mak</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Ibu (informal)</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Oreng towah</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Orang tua</div>
            </div>

            <h2>Orang Tua (Tingkat Halus)</h2>

            <p class="section-text-detail-bahasa">
                Panggilan formal untuk orang tua:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Rama</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Ayah (formal)</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ebhu</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Ibu (formal)</div>
            </div>

            <h2>Kakek dan Nenek</h2>

            <p class="section-text-detail-bahasa">
                Panggilan untuk generasi di atas orang tua:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Aghung lake\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Kakek</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Aghung bine\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Nenek</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Embah</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Kakek/Nenek (umum)</div>
            </div>

            <h2>Saudara Kandung</h2>

            <p class="section-text-detail-bahasa">
                Sebutan untuk kakak dan adik:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Kaka\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Kakak</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Adhi\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Adik</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sodara</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Saudara</div>
            </div>

            <h2>Keluarga Besar</h2>

            <p class="section-text-detail-bahasa">
                Anggota keluarga lainnya:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Om</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Paman</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Tante/Bi\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Bibi</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Keponakan</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Keponakan</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sepupu</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Sepupu</div>
            </div>

            <h2>Status Pernikahan</h2>

            <p class="section-text-detail-bahasa">
                Istilah yang berhubungan dengan pernikahan:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Lake\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Laki-laki/Suami</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Bine\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Perempuan/Istri</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Anak</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Anak</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Mantong</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Menantu</div>
            </div>
        ';
    }

    private function getHurufContent()
    {
        return '
            <h1>Pengenalan Huruf Madura</h1>

            <p class="intro-text-detail-bahasa">
                Bahasa Madura (Bhâsa Madhurâ) adalah bahasa Austronesia yang dituturkan oleh sekitar 14 juta orang
                di Pulau Madura dan Jawa Timur.
            </p>

            <div class="divider-detail-bahasa"></div>

            <h2>Sistem Penulisan</h2>

            <p class="section-text-detail-bahasa">
                Bahasa Madura menggunakan tiga sistem penulisan: huruf Latin (modern), aksara Jawa, dan aksara
                Arab-Pegon (tradisional). Saat ini, huruf Latin paling umum digunakan dalam pendidikan dan media.
            </p>

            <h2>Alfabet Dasar</h2>

            <p class="section-text-detail-bahasa">
                Bahasa Madura menggunakan 26 huruf alfabet Latin standar dengan beberapa tambahan untuk bunyi khas
                Madura:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Bhâsa</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Bahasa (dengan bunyi bh)</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Madhurâ</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Madura (dengan bunyi dh)</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ḍâ</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Bunyi d retroflex khas Madura</div>
            </div>

            <h2>Tingkat Tutur</h2>

            <p class="section-text-detail-bahasa">
                Bahasa Madura memiliki tingkatan bahasa yang penting dipahami:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ènjâ\'-iyâ</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Tingkat kasar/biasa (untuk teman sebaya)</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Èngghi-bhunten</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Tingkat halus (untuk orang tua/dihormati)</div>
            </div>
        ';
    }

    private function getSapaanContent()
    {
        return '
            <h1>Sapaan dan Perkenalan</h1>

            <p class="intro-text-detail-bahasa">
                Pelajari cara menyapa dan memperkenalkan diri dalam Bahasa Madura dengan sopan dan benar.
            </p>

            <div class="divider-detail-bahasa"></div>

            <h2>Salam dan Sapaan Dasar</h2>

            <p class="section-text-detail-bahasa">
                Berikut adalah sapaan yang umum digunakan dalam kehidupan sehari-hari:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Selamat Pagi</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Selamat Pagi</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Selamat Siang</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Selamat Siang</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Selamat Sore</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Selamat Sore</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Selamat Malam</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Selamat Malam</div>
            </div>

            <h2>Menanyakan Kabar</h2>

            <p class="section-text-detail-bahasa">
                Cara menanyakan kabar dalam bahasa Madura:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sapaneka kabar?</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Apa kabar?</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sae-sae bae</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Baik-baik saja</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Panjenengan sehat?</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Anda sehat? (halus)</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sehat</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Sehat</div>
            </div>

            <h2>Perkenalan Diri</h2>

            <p class="section-text-detail-bahasa">
                Memperkenalkan diri dalam bahasa Madura:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Abdhina nama saya...</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Nama saya... (halus)</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sengko\' asal dhari...</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Saya berasal dari...</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Matornuwun</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Terima kasih</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sami-sami</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Sama-sama</div>
            </div>

            <h2>Ungkapan Sopan Santun</h2>

            <p class="section-text-detail-bahasa">
                Kata-kata penting untuk kesopanan:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Tambe\'</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Maaf/Permisi</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Engghi</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Ya (halus)</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Bhunten</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Tidak (halus)</div>
            </div>
            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Samporna</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Tolong</div>
            </div>
        ';
    }

    private function getKosakataDasarOsing()
    {
        return '
            <h1>Kosakata Dasar</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Kata Ganti</h2>

            <p class="section-text-detail-bahasa">
                Berikut adalah kata ganti dalam bahasa Osing:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ingsun</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Saya</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Koen</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Kamu</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Budaya Dheweke</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Dia</div>
            </div>

            <h2>Sapaan Umum</h2>

            <p class="section-text-detail-bahasa">
                Sapaan yang sering digunakan sehari-hari:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Piye kabare?</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Apa kabar?</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Matur nuwun</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Terima kasih</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Nggih</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Ya</div>
            </div>
        ';
    }

    private function getLaguPantunOsing()
    {
        return '
            <h1>Lagu dan Pantun Osing</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Lagu Osing</h2>

            <p class="section-text-detail-bahasa">
                Lagu-lagu tradisional Osing mencerminkan kehidupan dan budaya masyarakat Banyuwangi. Setiap lagu
                memiliki makna dan filosofi yang mendalam.
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa"><b>Lagu 1</b> <br>
                    Banyuwangi ijo royo-royo, <br>
                    Sawah ladang katon nyawiji. <br>
                    Gunung Ijen mbesemi ati, <br>
                    Segara biru gawe tentreming jiwa. <br>
                    <br>
                    Taman sari kembang mekar, <br>
                    Gandane semerbak ngoyak rasa. <br>
                    Lirang-lirang angin seger, <br>
                    Ngundang tresna ati nyawiji. <br>
                    <br>
                    Gandrung joged ing alun-alun, <br>
                    Swarane gamelan nyawiji. <br>
                    Sambung rasa wong Blambangan, <br>
                    Tansah guyub rukun selawase. <br>
                    <br>
                    Adat budaya tetep dijaga, <br>
                    Warisan leluhur ora lali. <br>
                    Banyuwangi bumi tercinta, <br>
                    Mugo lestari nganti slamane. <br>
                    <br>
                    Ayune bumi Blambangan, <br>
                    Tansah elok lan nyawiji. <br>
                    Kulo tresna tanah kelairan, <br>
                    Banyuwangi sejati.
                </div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">
                    <b>Terjemahan</b> <br>
                    Banyuwangi hijau penuh pesona,<br>
                    Sawah ladang tampak menyatu.<br>
                    Gunung Ijen menyejukkan hati,<br>
                    Laut biru membawa ketenangan jiwa.<br>
                    <br>
                    Taman bunga merekah indah,<br>
                    Harumnya semerbak menggugah rasa.<br>
                    Semilir angin terasa segar,<br>
                    Mengundang cinta hati menyatu.<br>
                    <br>
                    Tari Gandrung di alun-alun,<br>
                    Suara gamelan berpadu indah.<br>
                    Persaudaraan orang Blambangan,<br>
                    Selalu rukun selamanya.<br>
                    <br>
                    Adat budaya tetap dijaga,<br>
                    Warisan leluhur takkan terlupa.<br>
                    Banyuwangi bumi tercinta,<br>
                    Semoga abadi sepanjang masa.<br>
                    <br>
                    Indahnya bumi Blambangan,<br>
                    Selalu elok dan menyatu.<br>
                    Aku cinta tanah kelahiran,<br>
                    Banyuwangi sejati.<br>
                </div>
            </div>

            <h2>Pantun Osing</h2>

            <p class="section-text-detail-bahasa">
                Pantun dalam budaya Osing digunakan dalam berbagai acara adat dan upacara tradisional. Pantun ini
                biasanya berisi nasihat, doa, dan harapan baik.
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa"><b>Pantun 1</b><br>
                    Lunga pasar tuku beras,<br>
                    Nggawa tekon ing omah putra.<br>
                    Aja lali sinau saben dhas,<br>
                    Supaya pinter lan dadi guna.
                </div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa"><b>Terjemahan</b> <br>
                    Pergi ke pasar membeli beras,<br>
                    Dibawa pulang untuk keluarga.<br>
                    Jangan lupa belajar setiap hari,<br>
                    Agar pintar dan bermanfaat bagi sesama.
                </div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa"><b>Pantun 2</b><br>
                    Manuk prenjak mabur ing sawah,<br>
                    Nggolek pangan esuk sore.<br>
                    Sing sregep sekolah ojo ngelawah,<br>
                    Mugo sukses tekan sore.
                </div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa"><b>Terjemahan</b><br>
                    Burung prenjak terbang di sawah,<br>
                    Mencari makan pagi hingga sore.<br>
                    Rajinlah sekolah jangan malas,<br>
                    Semoga sukses sampai tua nanti.
                </div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa"><b>Pantun 3</b><br>
                    Segara biru ombake nglimpah,<br>
                    Layar prau nglayang-layang.<br>
                    Ati resik tumindak becik,<br>
                    Urip ayem tansah ayem.
                </div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa"><b>Terjemahan</b><br>
                    Laut biru ombaknya melimpah,<br>
                    Layar perahu berayun-ayun.<br>
                    Hati bersih berbuat baik,<br>
                    Hidup tenteram selalu damai.
                </div>
            </div>
        ';
    }

    private function getPengenalanOsing()
    {
        return '
            <h1>Pengenalan Bahasa Osing</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Sejarah Bahasa Osing</h2>

            <p class="section-text-detail-bahasa">
                Bahasa Osing adalah bahasa yang digunakan oleh suku Osing di Banyuwangi, Jawa Timur. Bahasa ini memiliki
                keunikan tersendiri dalam pelafalan dan kosakata yang berbeda dari bahasa Jawa pada umumnya.
            </p>

            <h2>Ciri Khas Bahasa Osing</h2>

            <p class="section-text-detail-bahasa">
                Bahasa Osing memiliki beberapa ciri khas:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Pelafalan Khas</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Memiliki intonasi dan aksen yang berbeda</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Kosakata Unik</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Banyak kosakata yang tidak ditemukan di bahasa Jawa lainnya</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Budaya Lokal</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Mencerminkan kearifan lokal masyarakat Osing</div>
            </div>
        ';
    }

    private function getPercakapanOsing()
    {
        return '
            <h1>Percakapan Dasar</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Dialog Sederhana</h2>

            <p class="section-text-detail-bahasa">
                Contoh percakapan dasar dalam bahasa Osing:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">A: Piye kabare?</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">A: Apa kabar?</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">B: Apik-apik</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">B: Baik-baik</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">A: Arep nyang endi?</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">A: Mau kemana?</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">B: Arep nyang pasar</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">B: Mau ke pasar</div>
            </div>
        ';
    }
}
