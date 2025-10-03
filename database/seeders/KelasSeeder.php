<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Pelajaran;

class KelasSeeder extends Seeder
{

    public function run()
    {
        $kelas1 = Kelas::create([
            'judul' => 'Musik Pendalungan',
            'deskripsi' => 'Pelajari harmoni sempurna dari berbagai tradisi musikal Pendalungan',
            'icon' => '🎵',
            'kategori' => 'Pemula',
            'warna_kategori' => '#FF8C42',
            'jumlah_pelajaran' => 3,
            'durasi' => 4,
            'status' => true,
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas1->id,
            'judul' => 'Pengenalan Musik Pendalungan',
            'durasi' => 15,
            'deskripsi' => "Musik Pendalungan adalah harmoni sempurna dari berbagai tradisi musikal. Gamelan, angklung, dan berbagai instrumen perkusi menciptakan suara yang khas dan memukau.\n\nMusik ini tidak hanya hiburan, tetapi juga media komunikasi spiritual dan sosial masyarakat.",
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas1->id,
            'judul' => 'Gamelan Banyuwangen',
            'durasi' => 25,
            'deskripsi' => "Gamelan Banyuwangen adalah ansambel musik tradisional yang terdiri dari berbagai instrumen perkusi perunggu. Setiap instrumen memiliki peran dan fungsinya masing-masing dalam menciptakan harmoni yang indah.\n\nDalam pembelajaran ini, Anda akan mengenal berbagai instrumen gamelan seperti gong, kenong, saron, dan bonang.",
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas1->id,
            'judul' => 'Teknik Bermain Angklung',
            'durasi' => 20,
            'deskripsi' => "Angklung adalah alat musik multitonal yang terbuat dari bambu. Teknik memainkannya memerlukan koordinasi dan kekompakan yang baik antar pemain.\n\nPelajari teknik dasar menggoyang angklung, membaca notasi, dan berkolaborasi dalam ansambel angklung.",
            'urutan' => 3
        ]);

        // Kelas 2: Tarian Tradisional
        $kelas2 = Kelas::create([
            'judul' => 'Tarian Tradisional Pendalungan',
            'deskripsi' => 'Kuasai gerakan dan filosofi di balik tarian tradisional daerah',
            'icon' => '💃',
            'kategori' => 'Menengah',
            'warna_kategori' => '#667eea',
            'jumlah_pelajaran' => 4,
            'durasi' => 6,
            'status' => true,
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Sejarah Tarian Pendalungan',
            'durasi' => 20,
            'deskripsi' => "Tarian Pendalungan merupakan perpaduan unik antara tarian Jawa dan Madura. Setiap gerakan memiliki makna filosofis yang mendalam.\n\nPelajari asal-usul tarian, perkembangannya, dan makna di balik setiap gerakan.",
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Gerakan Dasar Tari Gandrung',
            'durasi' => 30,
            'deskripsi' => "Tari Gandrung adalah tarian khas Banyuwangi yang menggambarkan kegembiraan dan keanggunan. Gerakan dasar meliputi langkah kaki, ayunan tangan, dan ekspresi wajah.\n\nLatihan gerakan dasar ini akan menjadi fondasi untuk menguasai tarian yang lebih kompleks.",
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Kostum dan Properti Tari',
            'durasi' => 15,
            'deskripsi' => "Kostum tari Pendalungan memiliki makna simbolis yang mendalam. Warna, motif, dan aksesori dipilih sesuai dengan karakter tarian.\n\nPelajari jenis-jenis kostum, cara memakainya, dan properti pendukung seperti selendang dan kipas.",
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Koreografi Lengkap',
            'durasi' => 40,
            'deskripsi' => "Gabungkan semua gerakan dasar menjadi koreografi lengkap. Pelajari formasi, transisi antar gerakan, dan sinkronisasi dengan musik.\n\nPada akhir pelajaran ini, Anda akan mampu membawakan satu tarian lengkap dengan percaya diri.",
            'urutan' => 4
        ]);

        // Kelas 3: Bahasa Osing
        $kelas3 = Kelas::create([
            'judul' => 'Bahasa Osing untuk Pemula',
            'deskripsi' => 'Mulai percakapan sehari-hari dalam bahasa lokal Pendalungan',
            'icon' => '🗣️',
            'kategori' => 'Pemula',
            'warna_kategori' => '#48bb78',
            'jumlah_pelajaran' => 5,
            'durasi' => 5,
            'status' => true,
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Pengenalan Bahasa Osing',
            'durasi' => 15,
            'deskripsi' => "Bahasa Osing adalah bahasa asli masyarakat Banyuwangi yang masih digunakan hingga saat ini. Bahasa ini memiliki keunikan tersendiri dengan pengaruh Jawa dan Madura.\n\nPelajari sejarah, karakteristik, dan pentingnya melestarikan bahasa Osing sebagai warisan budaya.",
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Kosakata Dasar Sehari-hari',
            'durasi' => 20,
            'deskripsi' => "Mulai dengan kosakata dasar yang sering digunakan dalam kehidupan sehari-hari. Pelajari cara menyapa, memperkenalkan diri, angka, hari, dan kata-kata umum lainnya.\n\nLatihan pengucapan yang benar sangat penting untuk dikuasai sejak awal.",
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Struktur Kalimat Sederhana',
            'durasi' => 25,
            'deskripsi' => "Pelajari cara menyusun kalimat sederhana dalam bahasa Osing. Pahami pola subjek-predikat-objek dan penggunaan kata kerja.\n\nBerlatih membuat kalimat sendiri untuk memperkuat pemahaman struktur bahasa.",
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Percakapan Praktis',
            'durasi' => 30,
            'deskripsi' => "Praktikkan percakapan dalam situasi nyata seperti di pasar, bertanya arah, dan berbicara dengan tetangga.\n\nDialog interaktif akan membantu Anda lebih percaya diri berbicara bahasa Osing.",
            'urutan' => 4
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Peribahasa dan Ungkapan',
            'durasi' => 18,
            'deskripsi' => "Peribahasa Osing mengandung nilai-nilai kearifan lokal yang mendalam. Pelajari makna dan penggunaan berbagai peribahasa dalam konteks yang tepat.\n\nMemahami peribahasa akan memperkaya kemampuan berbahasa dan pemahaman budaya Anda.",
            'urutan' => 5
        ]);

        // Kelas 4: Kuliner Tradisional
        $kelas4 = Kelas::create([
            'judul' => 'Kuliner Tradisional Pendalungan',
            'deskripsi' => 'Belajar memasak hidangan khas dengan resep autentik',
            'icon' => '🍲',
            'kategori' => 'Menengah',
            'warna_kategori' => '#ed8936',
            'jumlah_pelajaran' => 6,
            'durasi' => 8,
            'status' => true,
            'urutan' => 4
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Pengenalan Kuliner Pendalungan',
            'durasi' => 12,
            'deskripsi' => "Kuliner Pendalungan adalah perpaduan cita rasa Jawa dan Madura yang unik. Penggunaan rempah-rempah lokal menciptakan karakteristik rasa yang khas.\n\nPelajari sejarah, bahan-bahan khas, dan filosofi di balik setiap hidangan tradisional.",
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Resep Rujak Soto',
            'durasi' => 35,
            'deskripsi' => "Rujak Soto adalah hidangan khas Banyuwangi yang memadukan kesegaran rujak dengan kehangatan soto. Kombinasi unik ini menciptakan rasa yang tak terlupakan.\n\nPelajari cara membuat kuah, menyiapkan bumbu, dan teknik penyajian yang benar.",
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Membuat Pecel Rawon',
            'durasi' => 40,
            'deskripsi' => "Pecel Rawon adalah inovasi kuliner yang menggabungkan pecel dan rawon. Kuah rawon yang kaya rempah dipadukan dengan sayuran pecel yang segar.\n\nTeknik membuat kuah rawon hitam yang pekat dan bumbu pecel yang pas adalah kunci kelezatan hidangan ini.",
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Jajanan Pasar Tradisional',
            'durasi' => 25,
            'deskripsi' => "Jajanan pasar Pendalungan sangat beragam, mulai dari kue basah hingga kue kering. Setiap jajanan memiliki teknik pembuatan yang berbeda.\n\nPelajari cara membuat klepon, onde-onde, dan lupis dengan teknik tradisional yang autentik.",
            'urutan' => 4
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Minuman Tradisional',
            'durasi' => 20,
            'deskripsi' => "Minuman tradisional seperti dawet, es campur khas, dan wedang ronde memiliki tempat khusus di hati masyarakat Pendalungan.\n\nPelajari resep dan teknik pembuatan minuman tradisional yang menyegarkan dan menyehatkan.",
            'urutan' => 5
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Seni Penyajian dan Presentasi',
            'durasi' => 18,
            'deskripsi' => "Penyajian makanan juga merupakan seni tersendiri. Pelajari cara menata hidangan agar terlihat menarik tanpa menghilangkan keaslian tradisional.\n\nTeknik garnish, pemilihan wadah, dan tata letak yang tepat akan membuat hidangan Anda lebih menggugah selera.",
            'urutan' => 6
        ]);
    }
}
