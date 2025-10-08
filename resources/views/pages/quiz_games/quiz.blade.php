@include('components.head')

@include('components.navbar')

<div class="container-quiz">
    <div class="header-quiz">
        <h1>Quiz & Gamifikasi Budaya</h1>
        <p>Uji pengetahuan budaya Pendalungan Anda melalui quiz interaktif dan tantangan menarik</p>
    </div>

    <div class="stats-grid-quiz">
        <div class="stat-card-quiz">
            <div class="stat-icon-quiz"><i class="bi bi-people"></i></div>
            <div class="stat-number-quiz">15,240</div>
            <div class="stat-label-quiz">Total Peserta</div>
        </div>
        <div class="stat-card-quiz">
            <div class="stat-icon-quiz"><i class="b bi-bullseye"></i></div>
            <div class="stat-number-quiz">178</div>
            <div class="stat-label-quiz">Total Soal</div>
        </div>
        <div class="stat-card-quiz">
            <div class="stat-icon-quiz"><i class="bi bi-clock"></i></div>
            <div class="stat-number-quiz">89%</div>
            <div class="stat-label-quiz">Tingkat Penyelesaian</div>
        </div>
        <div class="stat-card-quiz">
            <div class="stat-icon-quiz"><i class="bi bi-trophy"></i></div>
            <div class="stat-number-quiz">456</div>
            <div class="stat-label-quiz">Master Penyan</div>
        </div>
    </div>

    <h2 class="section-title-quiz" id="quiz">Kategori Quiz</h2>
    <div class="quiz-grid">
        <div class="quiz-card">
            <div class="quiz-badge badge-mudah">Mudah</div>
            <div class="quiz-icon"><i class="bi bi-bank2"></i></div>
            <h3 class="quiz-title">Sejarah Budaya</h3>
            <p class="quiz-description">Uji pengetahuan tentang sejarah dan perkembangan budaya Pendalungan</p>
            <div class="quiz-stats">
                <span>Soal:</span>
                <span>22</span>
            </div>
            <div class="quiz-stats">
                <span>Peserta:</span>
                <span>456</span>
            </div>
            <button class="quiz-btn" onclick="window.location= '{{ route('sejarah-budaya-quiz') }}'">Mulai Quiz</button>
        </div>

        <div class="quiz-card">
            <div class="quiz-badge badge-sedang">Sedang</div>
            <div class="quiz-icon"><i class="bi bi-chat-dots"></i></div>
            <h3 class="quiz-title">Bahasa Daerah</h3>
            <p class="quiz-description">Quiz tentaang tata bahasa Madura, Jawa, dan Osing</p>
            <div class="quiz-stats">
                <span>Soal:</span>
                <span>22</span>
            </div>
            <div class="quiz-stats">
                <span>Peserta:</span>
                <span>456</span>
            </div>
            <button class="quiz-btn" onclick="window.location= '{{ route('bahasa-daerah-quiz') }}'">Mulai Quiz</button>
        </div>

        <div class="quiz-card">
            <div class="quiz-badge badge-sedang">Sedang</div>
            <div class="quiz-icon"><i class="bi bi-palette"></i></div>
            <h3 class="quiz-title">Seni & Kerajinan</h3>
            <p class="quiz-description">Pelajawari seni dan budaya tradisional dan kemiran tangan</p>
            <div class="quiz-stats">
                <span>Soal:</span>
                <span>22</span>
            </div>
            <div class="quiz-stats">
                <span>Peserta:</span>
                <span>456</span>
            </div>
            <button class="quiz-btn" onclick="window.location= '{{ route('seni-kerajinan-quiz') }}'">Mulai Quiz</button>
        </div>

        <div class="quiz-card">
            <div class="quiz-badge badge-mudah">Mudah</div>
            <div class="quiz-icon"><i class="bi bi-egg-fried"></i></div>
            <h3 class="quiz-title">Kuliner Tradisional</h3>
            <p class="quiz-description">Seberapa kenal kamu dengan makanan khas Pendalungan?</p>
            <div class="quiz-stats">
                <span>Soal:</span>
                <span>22</span>
            </div>
            <div class="quiz-stats">
                <span>Peserta:</span>
                <span>456</span>
            </div>
            <button class="quiz-btn" onclick="window.location= '{{ route('kuliner-tradisional-quiz') }}'">Mulai
                Quiz</button>
        </div>

        <div class="quiz-card">
            <div class="quiz-badge badge-sulit">Sulit</div>
            <div class="quiz-icon"><i class="bi bi-music-note-beamed"></i></div>
            <h3 class="quiz-title">Tarian & Musik</h3>
            <p class="quiz-description">Quiz tentang tarian tradisional dan alat musik daerah</p>
            <div class="quiz-stats">
                <span>Soal:</span>
                <span>22</span>
            </div>
            <div class="quiz-stats">
                <span>Peserta:</span>
                <span>456</span>
            </div>
            <button class="quiz-btn" onclick="window.location= '{{ route('tarian-musik-quiz') }}'">Mulai Quiz</button>
        </div>

        <div class="quiz-card">
            <div class="quiz-badge badge-sulit">Sulit</div>
            <div class="quiz-icon"><i class="bi bi-fire"></i></div>
            <h3 class="quiz-title">Upacara Adat</h3>
            <p class="quiz-description">Tradisi dan upacara adat yang masih dilaksanakan</p>
            <div class="quiz-stats">
                <span>Soal:</span>
                <span>22</span>
            </div>
            <div class="quiz-stats">
                <span>Peserta:</span>
                <span>456</span>
            </div>
            <button class="quiz-btn" onclick="window.location= '{{ route('upacara-adat-quiz') }}'">Mulai Quiz</button>
        </div>
    </div>

    <div class="two-column">
        <div>
            <h2 class="section-title-quiz">Pencapaian</h2>
            <div class="achievement-item">
                <div class="achievement-icon"><i class="bi bi-trophy"></i></div>
                <div class="achievement-content">
                    <div class="achievement-title">Pemula Budaya</div>
                    <div class="achievement-desc">Berhasil 5 quiz pertama</div>
                    <div class="achievement-progress">
                        <div class="achievement-bar" style="width: 80%"></div>
                    </div>
                </div>
                <div class="achievement-percent">80%</div>
            </div>

            <div class="achievement-item">
                <div class="achievement-icon"><i class="bi bi-trophy"></i></div>
                <div class="achievement-content">
                    <div class="achievement-title">Penjelajah Tradisi</div>
                    <div class="achievement-desc">Ikseiksi 100 soal dengan benar</div>
                    <div class="achievement-progress">
                        <div class="achievement-bar" style="width: 45%"></div>
                    </div>
                </div>
                <div class="achievement-percent">45%</div>
            </div>

            <div class="achievement-item">
                <div class="achievement-icon"><i class="bi bi-trophy"></i></div>
                <div class="achievement-content">
                    <div class="achievement-title">Master Pendalungan</div>
                    <div class="achievement-desc">Dahi 100 sempurna di semua kategori</div>
                    <div class="achievement-progress">
                        <div class="achievement-bar" style="width: 20%"></div>
                    </div>
                </div>
                <div class="achievement-percent">20%</div>
            </div>

            <div class="achievement-item">
                <div class="achievement-icon"><i class="bi bi-trophy"></i></div>
                <div class="achievement-content">
                    <div class="achievement-title">Komunitas Expert</div>
                    <div class="achievement-desc">Bantu 10 pengguna lain</div>
                    <div class="achievement-progress">
                        <div class="achievement-bar" style="width: 60%"></div>
                    </div>
                </div>
                <div class="achievement-percent">60%</div>
            </div>
        </div>

        <div>
            <h2 class="section-title-quiz">Papan Peringkat</h2>
            <div class="leaderboard-item">
                <div class="rank rank-1">1</div>
                <div class="profile-username">SA</div>
                <div class="user-info">
                    <div class="username">Siti Aminah</div>
                    <span class="user-level level-master">Master</span>
                </div>
                <div class="score">
                    <div class="score-number">9,850</div>
                    <div class="score-label">poin</div>
                </div>
            </div>

            <div class="leaderboard-item">
                <div class="rank rank-2">2</div>
                <div class="profile-username">BS</div>
                <div class="user-info">
                    <div class="username">Budi Santoso</div>
                    <span class="user-level level-expert">Expert</span>
                </div>
                <div class="score">
                    <div class="score-number">9,720</div>
                    <div class="score-label">poin</div>
                </div>
            </div>

            <div class="leaderboard-item">
                <div class="rank rank-3">3</div>
                <div class="profile-username">RW</div>
                <div class="user-info">
                    <div class="username">Rahma Wati</div>
                    <span class="user-level level-expert">Expert</span>
                </div>
                <div class="score">
                    <div class="score-number">9,640</div>
                    <div class="score-label">poin</div>
                </div>
            </div>

            <div class="leaderboard-item">
                <div class="rank rank-other">4</div>
                <div class="profile-username">AF</div>
                <div class="user-info">
                    <div class="username">Ahmad Fauzi</div>
                    <span class="user-level level-advanced">Advanced</span>
                </div>
                <div class="score">
                    <div class="score-number">9,580</div>
                    <div class="score-label">poin</div>
                </div>
            </div>

            <div class="leaderboard-item">
                <div class="rank rank-other">5</div>
                <div class="profile-username">NH</div>
                <div class="user-info">
                    <div class="username">Nur Hayati</div>
                    <span class="user-level level-advanced">Advanced</span>
                </div>
                <div class="score">
                    <div class="score-number">9,520</div>
                    <div class="score-label">poin</div>
                </div>
            </div>

            <div class="leaderboard-item">
                <div class="rank rank-other">6</div>
                <div class="profile-username">DK</div>
                <div class="user-info">
                    <div class="username">Dedi Kurniawan</div>
                    <span class="user-level level-advanced">Advanced</span>
                </div>
                <div class="score">
                    <div class="score-number">9,480</div>
                    <div class="score-label">poin</div>
                </div>
            </div>

            <div class="leaderboard-item">
                <div class="rank rank-other">7</div>
                <div class="profile-username">LM</div>
                <div class="user-info">
                    <div class="username">Lina Marlina</div>
                    <span class="user-level level-intermediate">Intermediate</span>
                </div>
                <div class="score">
                    <div class="score-number">9,350</div>
                    <div class="score-label">poin</div>
                </div>
            </div>

            <div class="leaderboard-item">
                <div class="rank rank-other">8</div>
                <div class="profile-username">EP</div>
                <div class="user-info">
                    <div class="username">Eko Prasetyo</div>
                    <span class="user-level level-intermediate">Intermediate</span>
                </div>
                <div class="score">
                    <div class="score-number">9,290</div>
                    <div class="score-label">poin</div>
                </div>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <div class="cta-icon"><i class="bi bi-trophy"></i></div>
        <h2 class="cta-title">Siap Menjadi Master Budaya?</h2>
        <p class="cta-subtitle">Mulai perjalanan quiz Anda dan raih peringkat tertasi!</p>
        <button class="cta-btn" id="startQuiz" s>Mulai Quiz Sekarang</button>
    </div>
</div>

@include('components.footer')

<script>
    document.getElementById('startQuiz').addEventListener('click', function() {
    document.getElementById('quiz').scrollIntoView({
        behavior: 'smooth' 
    });
});
    document.addEventListener('DOMContentLoaded', function() {
            const quizButtons = document.querySelectorAll('.quiz-btn');
            quizButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });

            const ctaButton = document.querySelector('.cta-btn');
            ctaButton.addEventListener('click', function() {
                this.style.transform = 'translateY(-2px) scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-2px) scale(1)';
                }, 150);
            });

            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px 0px -50px 0px'
            };

            const progressBars = document.querySelectorAll('.achievement-bar');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const bar = entry.target;
                        const width = bar.style.width;
                        bar.style.width = '0%';
                        bar.style.transition = 'width 1s ease-out';
                        setTimeout(() => {
                            bar.style.width = width;
                        }, 100);
                    }
                });
            }, observerOptions);

            progressBars.forEach(bar => observer.observe(bar));

            const cards = document.querySelectorAll('.quiz-card, .achievement-item, .leaderboard-item');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
</script>