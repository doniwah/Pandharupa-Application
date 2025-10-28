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
            @foreach($languages as $language)
            <div class="language-card">
                <div class="difficulty-badge {{ strtolower($language['difficulty']) }}">
                    {{ ucfirst($language['difficulty']) }}
                </div>
                <div class="language-indicator {{ $language['indicator_color'] }}"></div>
                <h3 class="language-name">{{ $language['name'] }}</h3>
                <p class="language-subname">{{ $language['native_name'] }}</p>
                <div class="language-stats">
                    <div class="stat-row">
                        <span>Penutur: {{ number_format($language['speakers'] / 1000000, 0) }} juta</span>
                    </div>
                    <div class="stat-row">
                        <span>Pelajaran: {{ $language['total_lessons'] }}</span>
                    </div>
                </div>
                <div class="progress-container">
                    <div class="progress-label">
                        <span>Progres Anda</span>
                        <span class="progress-percentage-text">{{ round($language['progress']) }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $language['progress'] }}%"
                            data-progress="{{ $language['progress'] }}"></div>
                    </div>
                </div>
                <a class="continue-btn" href="{{ $language['route'] }}">
                    {{ $language['progress'] > 0 ? 'Lanjutkan Belajar' : 'Mulai Belajar' }}
                </a>
            </div>
            @endforeach
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
                <p class="feature-description">Berlatih dengan sesama pelajar dari berbagai daerah</p>
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
            @foreach($learningPaths as $path)
            <div class="path-card">
                <span class="path-badge">{{ $path['level'] }}</span>
                <h3 class="path-title">{{ $path['name'] }}</h3>

                <div class="path-progress-bar">
                    <div class="path-progress-fill" style="width: {{ $path['progress_percentage'] }}%"
                        data-progress="{{ $path['progress_percentage'] }}"></div>
                </div>

                @foreach($path['lessons'] as $index => $lesson)
                @if($index < 3) <div class="lesson-item">
                    <span>{{ $lesson['title'] }}</span>
                    <i class="bi bi-arrow-right"></i>
            </div>
            @endif
            @endforeach

            <a class="start-path-btn" href="{{ $path['route'] }}">
                {{ $path['progress_percentage'] > 0 ? 'Lanjutkan Jalur' : 'Mulai Jalur Ini' }}
            </a>
        </div>
        @endforeach
</div>
</section>

<!-- Statistics from Database -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number" data-target="{{ $statistics['active_learners'] }}">0</div>
            <div class="stat-label">Pelajar Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" data-target="{{ $statistics['total_vocabulary'] }}">0</div>
            <div class="stat-label">Kosakata Tersedia</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" data-target="{{ $statistics['total_audio'] }}">0</div>
            <div class="stat-label">Audio Native Speaker</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" data-target="{{ $statistics['satisfaction_rate'] }}">0</div>
            <div class="stat-label">Tingkat Kepuasan</div>
        </div>
    </div>
</section>
</div>

@include('components.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars for languages
        const progressBars = document.querySelectorAll('.progress-fill');
        progressBars.forEach(bar => {
            const width = bar.getAttribute('data-progress') + '%';
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 300);
        });

        // Animate progress bars for learning paths
        const pathProgressBars = document.querySelectorAll('.path-progress-fill');
        pathProgressBars.forEach(bar => {
            const width = bar.getAttribute('data-progress') + '%';
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 500);
        });

        // Animate statistics numbers
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(number => {
            const target = parseInt(number.getAttribute('data-target'));
            let current = 0;
            const increment = target / 50;
            const isPercentage = number.parentElement.querySelector('.stat-label').textContent.includes('Kepuasan');

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    if (isPercentage) {
                        number.textContent = target + '%';
                    } else {
                        number.textContent = target.toLocaleString('id-ID');
                    }
                    clearInterval(timer);
                } else {
                    if (isPercentage) {
                        number.textContent = Math.floor(current) + '%';
                    } else {
                        number.textContent = Math.floor(current).toLocaleString('id-ID');
                    }
                }
            }, 40);
        });

        // Add hover effects for lesson items
        document.querySelectorAll('.lesson-item').forEach(item => {
            if (!item.classList.contains('more-lessons')) {
                item.addEventListener('click', function() {
                    this.style.backgroundColor = '#f8f9fa';
                    setTimeout(() => {
                        this.style.backgroundColor = 'transparent';
                    }, 200);
                });
            }
        });

        // Add fade-in animation for cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '0';
                    entry.target.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        entry.target.style.transition = 'all 0.6s ease-out';
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 100);

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.language-card, .path-card, .feature-card, .stat-card').forEach(card => {
            observer.observe(card);
        });
    });

    // Function to load learning path
    function loadLearningPath(languageId, pathId) {
        window.location.href = `/bahasa/${languageId}/path/${pathId}`;
    }

    // Refresh data when returning to page
    window.addEventListener('pageshow', function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            location.reload();
        }
    });
</script>
