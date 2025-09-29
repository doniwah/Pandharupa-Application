@include('components.head')
@include('components.navbar')
<div class="container container-bahasa">
    <!-- Hero Section -->
    <div class="hero-bahasa">
        <h1 class="hero-title-bahasa">Bahasa Daerah Pendalungan</h1>
        <p class="hero-subtitle-bahasa">Pelajari bahasa daerah yang hidup dan berkembang di kawasan Pendalungan</p>
    </div>

    <!-- Available Languages -->
    <section class="languages-section">
        <h2 class="section-title">Bahasa yang Tersedia</h2>
        <div class="languages-grid">
            <div class="language-card">
                <div class="difficulty-badge mudah">Mudah</div>
                <div class="language-indicator red"></div>
                <h3 class="language-name">Bahasa Madura</h3>
                <p class="language-subname">Basa Madhura</p>
                <div class="language-stats">
                    <div class="stat-row">
                        <span>Penutur: 15 juta</span>
                    </div>
                    <div class="stat-row">
                        <span>Pelajaran: 24</span>
                    </div>
                </div>
                <div class="progress-container">
                    <div class="progress-label">
                        <span>Progres Anda</span>
                        <span>65%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 65%"></div>
                    </div>
                </div>
                <button class="continue-btn">Lanjutkan Belajar</button>
            </div>

            <div class="language-card">
                <div class="difficulty-badge sedang">Sedang</div>
                <div class="language-indicator green"></div>
                <h3 class="language-name">Bahasa Jawa</h3>
                <p class="language-subname">Basa Jawa</p>
                <div class="language-stats">
                    <div class="stat-row">
                        <span>Penutur: 75 juta</span>
                    </div>
                    <div class="stat-row">
                        <span>Pelajaran: 32</span>
                    </div>
                </div>
                <div class="progress-container">
                    <div class="progress-label">
                        <span>Progres Anda</span>
                        <span>45%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 45%"></div>
                    </div>
                </div>
                <button class="continue-btn">Lanjutkan Belajar</button>
            </div>

            <div class="language-card">
                <div class="difficulty-badge mudah">Mudah</div>
                <div class="language-indicator blue"></div>
                <h3 class="language-name">Bahasa Osing</h3>
                <p class="language-subname">Basa Using</p>
                <div class="language-stats">
                    <div class="stat-row">
                        <span>Penutur: 400 ribu</span>
                    </div>
                    <div class="stat-row">
                        <span>Pelajaran: 18</span>
                    </div>
                </div>
                <div class="progress-container">
                    <div class="progress-label">
                        <span>Progres Anda</span>
                        <span>80%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 80%"></div>
                    </div>
                </div>
                <button class="continue-btn">Lanjutkan Belajar</button>
            </div>
        </div>
    </section>

    <!-- Learning Features -->
    <section class="features-section">
        <h2 class="section-title">Fitur Pembelajaran</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="bi bi-volume-up"></i></div>
                <h3 class="feature-title">Audio Native Speaker</h3>
                <p class="feature-description">Dengarkan pengucapan asli dari penutur native</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="bi bi-book"></i></div>
                <h3 class="feature-title">Kamus Digital</h3>
                <p class="feature-description">Akses ribuan kosakata dengan terjemahan lengkap</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="bi bi-people"></i></div>
                <h3 class="feature-title">Komunitas Belajar</h3>
                <p class="feature-description">Berlatih dengan sesama pelajar dan berbagai daerah</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="bi bi-trophy"></i></div>
                <h3 class="feature-title">Latihan Hafalan</h3>
                <p class="feature-description">Sistem spaced repetition untuk mengoptimalkan hafalan</p>
            </div>
        </div>
    </section>

    <!-- Learning Paths -->
    <section class="learning-paths">
        <h2 class="section-title">Jalur Pembelajaran</h2>
        <div class="paths-grid">
            <div class="path-card">
                <span class="path-badge">Pemula</span>
                <h3 class="path-title">Dasar-Dasar Bahasa</h3>
                <div class="lesson-item">
                    <span>Pengenalan Huruf dan Suara</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Kosakata Sehari-hari</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Angka dan Waktu</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Keluarga dan Profesi</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <button class="start-path-btn">Mulai Jalur Ini</button>
            </div>

            <div class="path-card">
                <span class="path-badge">Menengah</span>
                <h3 class="path-title">Percakapan Praktis</h3>
                <div class="lesson-item">
                    <span>Berkenalan dan Sapa</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Berbelanja di Pasar</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Tanya Arah dan Transportasi</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Makan dan Minuman</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <button class="start-path-btn">Mulai Jalur Ini</button>
            </div>

            <div class="path-card">
                <span class="path-badge">Lanjutan</span>
                <h3 class="path-title">Budaya dan Tradisi</h3>
                <div class="lesson-item">
                    <span>Upacara Adat</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Cerita Rakyat</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Pantun dan Puisi</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="lesson-item">
                    <span>Percakapan Formal</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <button class="start-path-btn">Mulai Jalur Ini</button>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">12,450</div>
                <div class="stat-label">Pelajar Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">8,900</div>
                <div class="stat-label">Kosakata Tersedia</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">156</div>
                <div class="stat-label">Audio Native Speaker</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">95%</div>
                <div class="stat-label">Tingkat Kepuasan</div>
            </div>
        </div>
    </section>
</div>

@include('components.footer')

<script>
    // Add interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Animate progress bars
            const progressBars = document.querySelectorAll('.progress-fill');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });

            // Animate numbers
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(number => {
                const finalNumber = number.textContent;
                let currentNumber = 0;
                const increment = parseInt(finalNumber.replace(/,/g, '').replace('%', '')) / 50;

                const timer = setInterval(() => {
                    currentNumber += increment;
                    if (currentNumber >= parseInt(finalNumber.replace(/,/g, '').replace('%', ''))) {
                        number.textContent = finalNumber;
                        clearInterval(timer);
                    } else {
                        if (finalNumber.includes(',')) {
                            number.textContent = Math.floor(currentNumber).toLocaleString();
                        } else if (finalNumber.includes('%')) {
                            number.textContent = Math.floor(currentNumber) + '%';
                        } else {
                            number.textContent = Math.floor(currentNumber);
                        }
                    }
                }, 50);
            });

            // Add click handlers
            document.querySelectorAll('.continue-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.textContent = 'Memuat...';
                    setTimeout(() => {
                        this.textContent = 'Lanjutkan Belajar';
                    }, 1000);
                });
            });

            document.querySelectorAll('.start-path-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.textContent = 'Memulai...';
                    setTimeout(() => {
                        this.textContent = 'Mulai Jalur Ini';
                    }, 1000);
                });
            });

            // Add hover effects for lesson items
            document.querySelectorAll('.lesson-item').forEach(item => {
                item.addEventListener('click', function() {
                    this.style.backgroundColor = '#f8f9fa';
                    setTimeout(() => {
                        this.style.backgroundColor = 'transparent';
                    }, 200);
                });
            });
        });
</script>
