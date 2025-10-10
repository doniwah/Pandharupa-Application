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
            'judul' => 'Pengenalan Budaya Pendalungan',
            'deskripsi_singkat' => 'Kelas fundamental ini merupakan gerbang masuk untuk memahami kompleksitas budaya Pendalungan',
            'deskripsi' => 'Kelas fundamental ini merupakan gerbang masuk untuk memahami kompleksitas budaya Pendalungan secara holistik. Peserta akan diajak melakukan perjalanan intelektual menelusuri proses kelahiran, pertumbuhan, dan perkembangan identitas kultural unik yang terbentuk dari percampuran harmonis antara budaya Jawa dan Madura. Materi dirancang berdasarkan penelitian etnografis mendalam selama lebih dari satu dekade, menggabungkan pendekatan historis, antropologis, dan sosiologis. Kelas ini tidak hanya menyajikan fakta-fakta kultural tetapi juga melatih peserta untuk menganalisis dinamika kontemporer masyarakat Pendalungan dalam konteks globalisasi. Setiap modul dilengkapi dengan studi kasus aktual, wawancara dengan pelaku budaya, dan analisis dokumen historis yang otentik',
            'icon' => '🎵',
            'kategori' => 'Pemula',
            'warna_kategori' => '#FF8C42',
            'jumlah_pelajaran' => 5,
            'durasi' => 1,
            'status' => true,
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas1->id,
            'judul' => 'Konsep Dasar dan Identitas Pendalungan',
            'durasi' => 70,
            'deskripsi' => "Mengurai makna filosofis Pendalungan sebagai entitas kultural yang dinamis, menganalisis perbedaan eksonim dan endonim dalam penamaan kelompok masyarakat, serta memetakan proses pembentukan identitas kolektif masyarakat Tapal Kuda melalui teori identitas Stuart Hall. Pembahasan mencakup analisis kritis terhadap deklarasi Kota Pendalungan oleh Bupati Faida tahun 2016 sebagai political act dalam konstruksi identitas",
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas1->id,
            'judul' => 'Etimologi dan Makna Simbolik "Pendalungan"',
            'durasi' => 65,
            'deskripsi' => "Menelusuri asal-usul linguistik kata Pendalungan melalui analisis komparatif berbagai kamus kuno (Bausastra Jawa-Indonesia, Javanese English Dictionary) dan naskah historis (Serat Centhini). Dekonstruksi metafora periuk besar sebagai simbol melting pot budaya, serta analisis makna ganda berbicara tanpa tata krama dalam konteks egalitarianisme masyarakat.",
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas1->id,
            'judul' => 'Sejarah Migrasi dan Formasi Sosial',
            'durasi' => 75,
            'deskripsi' => "Rekonstruksi sejarah gelombang migrasi orang Jawa dan Madura ke wilayah Tapal Kuda sejak abad ke-16 menggunakan teori migrasi Lee. Analisis faktor push-pull migration, dampak sistem perkebunan kolonial terhadap formasi sosial, dan proses terbentuknya masyarakat hybrid. Studi kasus migrasi bedol desa dan pola permukiman tanean lanjang.",
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas1->id,
            'judul' => 'Karakteristik Psiko-Sosial Masyarakat Pendalungan',
            'durasi' => 60,
            'deskripsi' => "Eksplorasi mendalam sifat-sifat khas masyarakat Pendalungan: keterbukaan, religiusitas, egalitarianisme, temperamen, etos kerja keras, dan solidaritas pragmatis. Analisis memori kolektif yang cair dan dampaknya terhadap preservasi budaya. Studi komparatif dengan masyarakat Jawa Mataraman dan Madura Pulau.",
            'urutan' => 4
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas1->id,
            'judul' => 'Pluralisme dalam Kehidupan Sehari-hari',
            'durasi' => 60,
            'deskripsi' => "Eksplorasi mendalam sifat-sifat khas masyStudi etnografis praktik multikulturalisme di Jember: mekanisme koeksistensi harmonis, peran agama Islam sebagai common platform, strategi resolusi konflik, dan kearifan lokal dalam menjaga keberagaman. Analisis konsep Bhinneka Tunggal Ika dalam konteks lokal.",
            'urutan' => 5
        ]);

        // Kelas 2: Tarian Tradisional
        $kelas2 = Kelas::create([
            'judul' => 'Bahasa Jemberan: Linguistik dan Praktek Komunikasi Sehari-hari',
            'deskripsi_singkat' => 'Kelas intensif ini menyajikan analisis linguistik komprehensif terhadap bahasa Jemberan',
            'deskripsi' => 'Kelas intensif ini menyajikan analisis linguistik komprehensif terhadap bahasa Jemberan sebagai living dialect yang terus berevolusi. Menggunakan pendekatan sosiolinguistik dan antropolinguistik, peserta akan mendalami struktur fonetik, morfologi, sintaksis, serta fenomena kebahasaan unik seperti alih kode (code-switching), campur kode (code-mixing), dan interferensi. Kelas dirancang secara metodologis dengan porsi teori 40% dan praktek 60%, termasuk simulasi percakapan dalam berbagai konteks sosial, analisis teks media lokal, dan workshop penulisan kreatif bahasa Jemberan. Dibimbing oleh linguis Universitas Jember dan penutur asli berpengalaman.',
            'icon' => '💃',
            'kategori' => 'Pemula',
            'warna_kategori' => '#667eea',
            'jumlah_pelajaran' => 5,
            'durasi' => 1,
            'status' => true,
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Fonetik dan Kosakata Unik Jemberan',
            'durasi' => 80,
            'deskripsi' => "Analisis sistem bunyi vokal dan konsonan khas Jemberan, pola penekanan kata, dan intonasi. Dekonstruksi kosakata unik seperti Sih koh ! (ekspresi menggoda), mbois (keren/kekinian), nggilani (menjijikkan), polae (tingkah/dikarenakan) beserta etimologi dan variasi makna kontekstualnya.",
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Fenomena Alih Kode dan Campur Kode',
            'durasi' => 75,
            'deskripsi' => "Studi sosiolinguistik tentang bilingualisme masyarakat Jember, mekanisme peralihan bahasa Jawa-Madura-Indonesia dalam satu percakapan, dan faktor sosio-psikologis yang mempengaruhinya. Analisis kontekstual penggunaan masing-masing bahasa dalam domain keluarga, pendidikan, pasar, dan agama.",
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Struktur Gramatikal dan Pola Kalimat',
            'durasi' => 75,
            'deskripsi' => "Analisis komparatif struktur gramatikal bahasa Jemberan dengan bahasa Jawa standar (Surakarta) dan Madura (Sumenep). Dekonstruksi pola kalimat khas seperti Gak onok,
            iki ku - mlaku dan pola ¾ seperti lun - alun (alun-alun), ku - mlaku (berjalan-jalan). Workshop penyusunan kalimat kompleks.",
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Ungkapan, Singkatan, dan Slang Kontemporer',
            'durasi' => 75,
            'deskripsi' => "Dekonstruksi ungkapan khas seperti cek enggake (tidak banget), kardhi (karepa dhibhik - semaunya sendiri), kardhiman (semaunya dan seenaknya sendiri), serta evolusi slang di kalangan generasi muda. Analisis pembentukan neologisme dan pengaruh media sosial.",
            'urutan' => 4
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas2->id,
            'judul' => 'Praktek Percakapan Kontekstual',
            'durasi' => 75,
            'deskripsi' => "Simulasi percakapan intensif dalam berbagai ranah: percakapan keluarga (parent-child interaction), transaksi pasar (market discourse), situasi pendidikan (classroom interaction), dan komunikasi media sosial (digital communication). Focus pada pragmatic competence dan cultural appropriateness.",
            'urutan' => 5
        ]);

        // Kelas 3: Bahasa Osing
        $kelas3 = Kelas::create([
            'judul' => 'Kesenian Tradisional Pendalungan: Bentuk, Makna, dan Fungsi Sosial',
            'deskripsi_singkat' => 'Eksplorasi mendalam dan komprehensif terhadap seluruh spektrum kesenian tradisional Pendalungan',
            'deskripsi' => 'Eksplorasi mendalam dan komprehensif terhadap seluruh spektrum kesenian tradisional Pendalungan melalui pendekatan etnografis dan semiotik. Kelas ini tidak hanya mengajarkan teknik dan bentuk kesenian, tetapi lebih penting lagi, menganalisis makna simbolik, fungsi sosial, konteks historis, dan transformasi kontemporer setiap genre kesenian. Peserta akan mendapatkan akses ke dokumentasi video langka, wawancara dengan maestro seniman, dan analisis partitur musikal yang detail. Dibimbing oleh akademisi seni dan praktisi budaya senior.',
            'icon' => '🗣️',
            'kategori' => 'Pemula',
            'warna_kategori' => '#48bb78',
            'jumlah_pelajaran' => 5,
            'durasi' => 1,
            'status' => true,
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Musik Patrol: Orkestra Kentungan Kayu',
            'durasi' => 80,
            'deskripsi' => "Sejarah evolusi musik patrol dari tradisi Madura ke bentuk hybrid Pendalungan. Analisis organologis detail: instrumentasi (kenthir, kenthar, ting-tung, bas), teknik pembuatan alat musik dari kayu nangka, sistem notasi tradisional, dan aransemen musikal. Studi fungsi sosial dalam bulan Ramadan: membangunkan sahur, ronda siskamling, dan festival tahunan.",
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Can-Macanan Kaddhuk dan Singo Ulung',
            'durasi' => 70,
            'deskripsi' => "Analisis komparatif kesenian topeng macan di Jember (Can-Macanan Kaddhuk) dan Bondowoso (Singo Ulung). Dekonstruksi makna simbolik macan dalam kosmologi Jawa-Madura, ritual persiapan pertunjukan, struktur koreografi, dan transformasi dalam konteks modern. Dokumentasi video pertunjukan lengkap.",
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Seni Jaranan dan Lengger',
            'durasi' => 25,
            'deskripsi' => "Studi komprehensif tari kuda lumping (jaranan) dan lengger sebagai ekspresi spiritualitas dan hiburan. Analisis aspek trance (intrance) dalam pertunjukan, fungsi ritual dalam hajatan, struktur musikal, dan transformasi koreografi dari tradisional ke kontemporer. Wawancara dengan penari dan pemain musik.",
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Kesenian Pesantren: Hadrah dan Terbangan',
            'durasi' => 70,
            'deskripsi' => "Eksplorasi seni bernuansa Islami di pondok pesantren Tapal Kuda. Analisis struktur musik hadrah dan terbangan, lirik pujian dalam bahasa Arab dan Jawa, teknik permainan rebana, dan perannya dalam pendidikan karakter santri. Studi kasus Pondok Pesantren Al Falah Silo.",
            'urutan' => 4
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas3->id,
            'judul' => 'Seni Barongsai dan Leang Leong',
            'durasi' => 65,
            'deskripsi' => "Analisis akulturasi kesenian Tionghoa dalam masyarakat Pendalungan. Sejarah perkembangan barongsai dan leang leong di Jember, struktur pertunjukan, makna simbolik warna dan gerakan, serta aspek multietnis dalam kelompok seni. Wawancara dengan keturunan Tionghoa pelaku seni.",
            'urutan' => 5
        ]);

        // Kelas 4: Kuliner Tradisional
        $kelas4 = Kelas::create([
            'judul' => 'Sejarah Migrasi dan Transformasi Sosial di Tapal Kuda',
            'deskripsi_singkat' => 'Kelas analitis-kritis yang menelusuri dinamika panjang migrasi dan transformasi',
            'deskripsi' => 'Kelas analitis-kritis yang menelusuri dinamika panjang migrasi dan transformasi sosial masyarakat Tapal Kuda dari perspektif sejarah sosial-ekonomi yang komprehensif. Menggunakan pendekatan sejarah total (total history) Braudel, kelas ini menganalisis tiga level temporal: jangka panjang (struktur geografis dan demografis), jangka menengah (konjungtur ekonomi dan politik), dan jangka pendek (peristiwa sejarah). Peserta akan bekerja dengan arsip kolonial, data statistik historis, dan narasi lisan untuk merekonstruksi proses formasi masyarakat Pendalungan. Dibimbing oleh sejarawan dan sosiolog spesialis sejarah Jawa Timur.',
            'icon' => '🍲',
            'kategori' => 'Pemula',
            'warna_kategori' => '#ed8936',
            'jumlah_pelajaran' => 5,
            'durasi' => 1,
            'status' => true,
            'urutan' => 4
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Gelombang Migrasi Awal ',
            'durasi' => 12,
            'deskripsi' => "Rekonstruksi migrasi era kerajaan Demak-Mataram menggunakan kitab Pararaton dan prasasti Mulamalurung. Analisis peran Arya Wiraraja dalam migrasi Madura ke Jawa, pola permukiman awal, dan formasi komunitas hybrid di perbatasan. Studi arkeologis situs-situs kuno Bondowoso-Jember.",
            'urutan' => 1
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Era Kolonial dan Sistem Perkebunan',
            'durasi' => 35,
            'deskripsi' => "Analisis dampak UU Agraria 1870 terhadap transformasi sosial-ekonomi Tapal Kuda. Studi tentang peran George Birnie sebagai pionir perkebunan tembakau, sistem rekruitmen buruh dari Madura dan Jawa, serta terbentuknya masyarakat multietnis di sekitar perkebunan. Analisis arsip kolonial dan laporan tahunan perkebunan.",
            'urutan' => 2
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Pola Permukiman Tanean Lanjang',
            'durasi' => 40,
            'deskripsi' => "Studi arsitektur dan antropologis permukiman Madura tanean lanjang dan transformasinya di tanah rantau. Analisis hierarki spatial (barat-timur menunjukkan tua-muda), struktur koren (rumpun bambu), dan adaptasi pola permukiman dalam konteks urban. Dokumentasi foto dan peta permukiman historis.",
            'urutan' => 3
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Proses Akulturasi dan Hibridisasi',
            'durasi' => 25,
            'deskripsi' => "Analisis mekanisme akulturasi budaya Jawa-Madura menggunakan teori akulturasi Berry. Studi faktor pendorong (perkawinan campuran, ekonomi pasar, pendidikan), hambatan (prasangka, stereotipe), dan hasil hibridisasi dalam bahasa, kesenian, dan sistem nilai. Studi kasus keluarga campuran Jawa-Madura.",
            'urutan' => 4
        ]);

        Pelajaran::create([
            'kelas_id' => $kelas4->id,
            'judul' => 'Dampak Sosial-Ekonomi Kontemporer',
            'durasi' => 20,
            'deskripsi' => "Analisis transformasi ekonomi agraris ke jasa dan industri kreatif. Studi perubahan struktur pekerjaan, dampak urbanisasi terhadap identitas kultural, dan peran pendidikan tinggi dalam mobilitas sosial. Data statistik BPS 2020-2023 dan proyeksi masa depan.",
            'urutan' => 5
        ]);
    }
}