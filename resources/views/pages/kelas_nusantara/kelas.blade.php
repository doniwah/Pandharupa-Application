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
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor"
                            class="bi bi-book" viewBox="0 0 16 16">
                            <path
                                d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                        </svg>
                    </div>
                    <div class="stat-number">125</div>
                    <div class="stat-label">Total Materi</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor"
                            class="bi bi-people" viewBox="0 0 16 16">
                            <path
                                d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                        </svg>
                    </div>
                    <div class="stat-number">2,450</div>
                    <div class="stat-label">Pelajar Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor"
                            class="bi bi-star" viewBox="0 0 16 16">
                            <path
                                d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                        </svg>
                    </div>
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Tingkat Kepuasan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor"
                            class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                        </svg>
                    </div>
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Akses Pembelajaran</div>
                </div>
            </div>
        </div>
    </section>

    <section class="topics">
        <div class="container">
            <h2 class="section-title">Topik Pembelajaran</h2>
            <div class="topics-grid">

                <div class="topic-card">
                    <div class="topic-icon">🏛️</div>
                    <div class="topic-meta">
                        <span class="topic-level">Pemula</span>
                        <span class="topic-students">12 pelajaran</span>
                    </div>
                    <h3 class="topic-title">Sejarah Budaya Pendalungan</h3>
                    <p class="topic-description">Pelajari asal-usul dan perkembangan budaya Pendalungan dari masa ke
                        masa</p>
                    <div class="topic-duration">Durasi: 4 minggu</div>
                    <button class="btn">Mulai Belajar</button>
                </div>


                <div class="topic-card">
                    <div class="topic-icon">🎭</div>
                    <div class="topic-meta">
                        <span class="topic-level intermediate">Menengah</span>
                        <span class="topic-students">18 pelajaran</span>
                    </div>
                    <h3 class="topic-title">Tarian Tradisional Pendalungan</h3>
                    <p class="topic-description">Kuasai gerakan dan filosofi di balik tarian tradisional daerah</p>
                    <div class="topic-duration">Durasi: 6 minggu</div>
                    <button class="btn">Mulai Belajar</button>
                </div>


                <div class="topic-card">
                    <div class="topic-icon">🎵</div>
                    <div class="topic-meta">
                        <span class="topic-level">Pemula</span>
                        <span class="topic-students">24 pelajaran</span>
                    </div>
                    <h3 class="topic-title">Musik dan Instrumen Tradisional</h3>
                    <p class="topic-description">Belajar memainkan alat musik tradisional Pendalungan</p>
                    <div class="topic-duration">Durasi: 8 minggu</div>
                    <button class="btn">Mulai Belajar</button>
                </div>


                <div class="topic-card">
                    <div class="topic-icon">🍜</div>
                    <div class="topic-meta">
                        <span class="topic-level">Pemula</span>
                        <span class="topic-students">9 pelajaran</span>
                    </div>
                    <h3 class="topic-title">Kuliner Khas Pendalungan</h3>
                    <p class="topic-description">Resep autentik dan teknik memasak makanan tradisional</p>
                    <div class="topic-duration">Durasi: 3 minggu</div>
                    <button class="btn">Mulai Belajar</button>
                </div>


                <div class="topic-card">
                    <div class="topic-icon">🎨</div>
                    <div class="topic-meta">
                        <span class="topic-level intermediate">Menengah</span>
                        <span class="topic-students">15 pelajaran</span>
                    </div>
                    <h3 class="topic-title">Kerajinan Tangan Tradisional</h3>
                    <p class="topic-description">Teknik pembuatan kerajinan khas daerah Pendalungan</p>
                    <div class="topic-duration">Durasi: 5 minggu</div>
                    <button class="btn">Mulai Belajar</button>
                </div>


                <div class="topic-card">
                    <div class="topic-icon">📖</div>
                    <div class="topic-meta">
                        <span class="topic-level advanced">Lanjutan</span>
                        <span class="topic-students">16 pelajaran</span>
                    </div>
                    <h3 class="topic-title">Sastra dan Cerita Rakyat</h3>
                    <p class="topic-description">Eksplorasi kekayaan sastra dan cerita rakyat Pendalungan</p>
                    <div class="topic-duration">Durasi: 4 minggu</div>
                    <button class="btn">Mulai Belajar</button>
                </div>
            </div>
        </div>
    </section>


    <section class="cta">
        <div class="container-cta">
            <h2>Siap Memulai Perjalanan Belajar?</h2>
            <p>Bergabunglah dengan ribuan pelajar lainnya dan kuasai budaya Pendalungan</p>
            <a href="#" class="btn-white">Daftar Kelas Gratis</a>
            <a href="#" class="btn-white">Lihat Kurikulum</a>
        </div>
    </section>


    @include('components.footer')
</body>

</html>
