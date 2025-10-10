<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Nusantara Pendalungan</title>
    <link rel="stylesheet" href="{{ asset('css/pages') }}/kelas_nusantara.css">
    <link rel="stylesheet" href="{{ asset('css') }}/navbar.css">
    <link rel="stylesheet" href="{{ asset('css') }}/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

</head>

<body>
    @include('components.navbar')
    <section class="hero">
        <div class="container">
            <h1>Kelas Nusantara Pendalungan</h1>
            <p>Jelajahi kekayaan budaya Pendalungan melalui pembelajaran terstruktur dan interaktif</p>
        </div>
    </section>
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                            fill="#e67e22">
                            <path
                                d="M260-320q47 0 91.5 10.5T440-278v-394q-41-24-87-36t-93-12q-36 0-71.5 7T120-692v396q35-12 69.5-18t70.5-6Zm260 42q44-21 88.5-31.5T700-320q36 0 70.5 6t69.5 18v-396q-33-14-68.5-21t-71.5-7q-47 0-93 12t-87 36v394Zm-40 118q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740q51-30 106.5-45T700-800q52 0 102 12t96 36q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59ZM280-494Z" />
                        </svg>
                    </div>
                    <div class="stat-number">{{ $stats['total_materi'] }}</div>
                    <div class="stat-label">Total Materi</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                            fill="#e67e22">
                            <path
                                d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
                        </svg>
                    </div>
                    <div class="stat-number">{{ number_format($stats['pelajar_aktif']) }}</div>
                    <div class="stat-label">Pelajar Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                            fill="#e67e22">
                            <path
                                d="m354-287 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-120l65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Z" />
                        </svg>
                    </div>
                    <div class="stat-number">{{ $stats['tingkat_kepuasan'] }}%</div>
                    <div class="stat-label">Tingkat Kepuasan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                            fill="#e67e22">
                            <path
                                d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z" />
                        </svg>
                    </div>
                    <div class="stat-number">{{ $stats['akses'] }}</div>
                    <div class="stat-label">Akses Pembelajaran</div>
                </div>
            </div>
        </div>
    </section>
    <section class="topics">
        <div class="container">
            <h2 class="section-title">Topik Pembelajaran</h2>
            <div class="topics-grid">
                @forelse($kelasList as $kelas)
                    <div class="topic-card">
                        <div class="topic-icon" style="color: #e67e22">{!! $kelas->icon !!}</div>
                        <div class="topic-meta">
                            <span
                                class="topic-level {{ $kelas->kategori == 'Menengah' ? 'intermediate' : ($kelas->kategori == 'Lanjutan' ? 'advanced' : '') }}">
                                {{ $kelas->kategori }}
                            </span>
                            <span class="topic-students">{{ $kelas->jumlah_pelajaran }} pelajaran</span>
                        </div>
                        <h3 class="topic-title">{{ $kelas->judul }}</h3>
                        <p class="topic-description">{{ $kelas->deskripsi_singkat }}</p>
                        <div class="topic-duration">Durasi: {{ $kelas->durasi }} minggu</div>
                        <a href="{{ route('kelas.show', $kelas->id) }}" class="btn">Mulai Belajar</a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Belum ada kelas tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('components.footer')
</body>

</html>
