<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz & Gamifikasi Budaya</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f6f3;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #8B6F47;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header p {
            color: #666;
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 1px solid #eee;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 15px;
            background: #FF8C42;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        .section-title {
            font-size: 1.8rem;
            color: #8B6F47;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .quiz-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 1px solid #eee;
            position: relative;
            transition: transform 0.3s ease;
        }

        .quiz-card:hover {
            transform: translateY(-3px);
        }

        .quiz-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-mudah { background: #E8F4E8; color: #2D7D32; }
        .badge-sedang { background: #FFF3E0; color: #F57C00; }
        .badge-sulit { background: #FFEBEE; color: #C62828; }

        .quiz-icon {
            width: 50px;
            height: 50px;
            background: #F5F5F5;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 24px;
        }

        .quiz-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .quiz-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .quiz-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .quiz-btn {
            width: 100%;
            background: #FF8C42;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .quiz-btn:hover {
            background: #E67A35;
        }

        .two-column {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-top: 40px;
        }

        .achievement-item {
            display: flex;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .achievement-icon {
            width: 40px;
            height: 40px;
            background: #FF8C42;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            font-size: 18px;
        }

        .achievement-content {
            flex: 1;
        }

        .achievement-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .achievement-desc {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .achievement-progress {
            background: #f0f0f0;
            height: 6px;
            border-radius: 3px;
            overflow: hidden;
        }

        .achievement-bar {
            height: 100%;
            background: #FF8C42;
            transition: width 0.3s ease;
        }

        .achievement-percent {
            color: #666;
            font-size: 0.9rem;
            margin-left: 15px;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .rank {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            color: white;
        }

        .rank-1 { background: #FFD700; }
        .rank-2 { background: #C0C0C0; }
        .rank-3 { background: #CD7F32; }
        .rank-other { background: #666; }

        .user-info {
            flex: 1;
        }

        .username {
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }

        .user-level {
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .level-pemula { background: #E3F2FD; color: #1976D2; }
        .level-expert { background: #F3E5F5; color: #7B1FA2; }
        .level-advanced { background: #E8F5E8; color: #388E3C; }
        .level-intermediate { background: #FFF3E0; color: #F57C00; }

        .score {
            text-align: right;
        }

        .score-number {
            font-weight: bold;
            color: #333;
            font-size: 1.1rem;
        }

        .score-label {
            color: #666;
            font-size: 0.8rem;
        }

        .cta-section {
            background: linear-gradient(135deg, #FF8C42, #FF7A2B);
            padding: 50px 30px;
            text-align: center;
            border-radius: 20px;
            margin-top: 50px;
            color: white;
        }

        .cta-icon {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 36px;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .cta-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .cta-btn {
            background: white;
            color: #FF8C42;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .cta-btn:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .two-column {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Quiz & Gamifikasi Budaya</h1>
            <p>Uji pengetahuan budaya Pendalungan Anda melalui quiz interaktif dan tantangan menarik</p>
        </div>

        <!-- Statistics Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-number">15,240</div>
                <div class="stat-label">Total Peserta</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎯</div>
                <div class="stat-number">178</div>
                <div class="stat-label">Total Soal</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⏱️</div>
                <div class="stat-number">89%</div>
                <div class="stat-label">Tingkat Penyelesaian</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏆</div>
                <div class="stat-number">456</div>
                <div class="stat-label">Master Penyan</div>
            </div>
        </div>

        <!-- Quiz Categories -->
        <h2 class="section-title">Kategori Quiz</h2>
        <div class="quiz-grid">
            <div class="quiz-card">
                <div class="quiz-badge badge-mudah">Mudah</div>
                <div class="quiz-icon">🏛️</div>
                <h3 class="quiz-title">Sejarah Budaya</h3>
                <p class="quiz-description">Uji pengetahuan tentang sejarah dan perkembangan budaya Pendalungan</p>
                <div class="quiz-stats">
                    <span>Soal: 25</span>
                    <span>Peserta: 1,230</span>
                </div>
                <button class="quiz-btn">Mulai Quiz</button>
            </div>

            <div class="quiz-card">
                <div class="quiz-badge badge-sedang">Sedang</div>
                <div class="quiz-icon">🗣️</div>
                <h3 class="quiz-title">Bahasa Daerah</h3>
                <p class="quiz-description">Quiz tentaang tata bahasa Madura, Jawa, dan Osing</p>
                <div class="quiz-stats">
                    <span>Soal: 40</span>
                    <span>Peserta: 890</span>
                </div>
                <button class="quiz-btn">Mulai Quiz</button>
            </div>

            <div class="quiz-card">
                <div class="quiz-badge badge-sedang">Sedang</div>
                <div class="quiz-icon">🎨</div>
                <h3 class="quiz-title">Seni & Kerajinan</h3>
                <p class="quiz-description">Pelajawari seni dan budaya tradisional dan kemiran tangan</p>
                <div class="quiz-stats">
                    <span>Soal: 30</span>
                    <span>Peserta: 675</span>
                </div>
                <button class="quiz-btn">Mulai Quiz</button>
            </div>

            <div class="quiz-card">
                <div class="quiz-badge badge-mudah">Mudah</div>
                <div class="quiz-icon">🍳</div>
                <h3 class="quiz-title">Kuliner Tradisional</h3>
                <p class="quiz-description">Seberapa kenal kamu dengan makanan khas Pendalungan?</p>
                <div class="quiz-stats">
                    <span>Soal: 35</span>
                    <span>Peserta: 1,420</span>
                </div>
                <button class="quiz-btn">Mulai Quiz</button>
            </div>

            <div class="quiz-card">
                <div class="quiz-badge badge-sulit">Sulit</div>
                <div class="quiz-icon">🎵</div>
                <h3 class="quiz-title">Tarian & Musik</h3>
                <p class="quiz-description">Quiz tentang tarian tradisional dan alat musik daerah</p>
                <div class="quiz-stats">
                    <span>Soal: 22</span>
                    <span>Peserta: 456</span>
                </div>
                <button class="quiz-btn">Mulai Quiz</button>
            </div>

            <div class="quiz-card">
                <div class="quiz-badge badge-sulit">Sulit</div>
                <div class="quiz-icon">⚕️</div>
                <h3 class="quiz-title">Upacara Adat</h3>
                <p class="quiz-description">Tradisi dan upacara adat yang masih dilaksanakan</p>
                <div class="quiz-stats">
                    <span>Soal: 18</span>
                    <span>Peserta: 320</span>
                </div>
                <button class="quiz-btn">Mulai Quiz</button>
            </div>
        </div>

        <!-- Two Column Section -->
        <div class="two-column">
            <!-- Achievements -->
            <div>
                <h2 class="section-title">Pencapaian</h2>
                <div class="achievement-item">
                    <div class="achievement-icon">🏆</div>
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
                    <div class="achievement-icon">🏆</div>
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
                    <div class="achievement-icon">🏆</div>
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
                    <div class="achievement-icon">🏆</div>
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

            <!-- Leaderboard -->
            <div>
                <h2 class="section-title">Papan Peringkat</h2>
                <div class="leaderboard-item">
                    <div class="rank rank-1">1</div>
                    <div class="user-info">
                        <div class="username">Siti Aminah</div>
                        <span class="user-level level-pemula">Pemula</span>
                    </div>
                    <div class="score">
                        <div class="score-number">9,850</div>
                        <div class="score-label">poin</div>
                    </div>
                </div>

                <div class="leaderboard-item">
                    <div class="rank rank-2">2</div>
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

        <!-- Call to Action -->
        <div class="cta-section">
            <div class="cta-icon">🏆</div>
            <h2 class="cta-title">Siap Menjadi Master Budaya?</h2>
            <p class="cta-subtitle">Mulai perjalanan quiz Anda dan raih peringkat tertasi!</p>
            <button class="cta-btn">Mulai Quiz Sekarang</button>
        </div>
    </div>

    <script>
        // Add interactive hover effects and animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to quiz buttons
            const quizButtons = document.querySelectorAll('.quiz-btn');
            quizButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });

            // Add click effect to CTA button
            const ctaButton = document.querySelector('.cta-btn');
            ctaButton.addEventListener('click', function() {
                this.style.transform = 'translateY(-2px) scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-2px) scale(1)';
                }, 150);
            });

            // Animate progress bars on scroll
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

            // Add hover effect to cards
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
</body>
</html>
