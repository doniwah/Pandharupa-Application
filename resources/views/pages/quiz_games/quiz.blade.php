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
            <div class="stat-number-quiz">{{ number_format($totalParticipants) }}</div>
            <div class="stat-label-quiz">Total Peserta</div>
        </div>
        <div class="stat-card-quiz">
            <div class="stat-icon-quiz"><i class="bi bi-bullseye"></i></div>
            <div class="stat-number-quiz">{{ $totalQuestions }}</div>
            <div class="stat-label-quiz">Total Soal</div>
        </div>
        <div class="stat-card-quiz">
            <div class="stat-icon-quiz"><i class="bi bi-clock"></i></div>
            <div class="stat-number-quiz">{{ $completionRate }}</div>
            <div class="stat-label-quiz">Rata-rata Waktu (menit)</div>
        </div>
        <div class="stat-card-quiz">
            <div class="stat-icon-quiz"><i class="bi bi-trophy"></i></div>
            <div class="stat-number-quiz">{{ $masterUsers }}</div>
            <div class="stat-label-quiz">Master Penyan</div>
        </div>
    </div>

    <h2 class="section-title-quiz" id="quiz">Kategori Quiz</h2>
    <div class="quiz-grid">
        @foreach($quizzes as $quiz)
        <div class="quiz-card">
            <div class="quiz-badge badge-{{ $quiz->difficulty }}">
                {{ ucfirst($quiz->difficulty) }}
            </div>
            <div class="quiz-icon"><i class="{{ $quiz->icon }}"></i></div>
            <h3 class="quiz-title">{{ $quiz->title }}</h3>
            <p class="quiz-description">{{ $quiz->description }}</p>
            <div class="quiz-stats">
                <span>Soal:</span>
                <span>{{ $quiz->questions_count }}</span>
            </div>
            <div class="quiz-stats">
                <span>Peserta:</span>
                <span>{{ $quiz->participant_count ?? 0 }}</span>
            </div>
            <button class="quiz-btn" onclick="window.location.href='{{ route('quiz.show', $quiz->id) }}'">
                Mulai Quiz
            </button>
        </div>
        @endforeach
    </div>

    <div class="two-column">
        <div>
            <h2 class="section-title-quiz">Pencapaian</h2>
            @foreach($achievements as $achievement)
            <div class="achievement-item">
                <div class="achievement-icon"><i class="{{ $achievement['icon'] }}"></i></div>
                <div class="achievement-content">
                    <div class="achievement-title">{{ $achievement['name'] }}</div>
                    <div class="achievement-desc">{{ $achievement['description'] }}</div>
                    <div class="achievement-progress">
                        <div class="achievement-bar" style="width: {{ $achievement['percentage'] }}%"></div>
                    </div>
                </div>
                <div class="achievement-percent">{{ $achievement['percentage'] }}%</div>
            </div>
            @endforeach
        </div>

        <div>
            <h2 class="section-title-quiz">Papan Peringkat</h2>
            @foreach($leaderboard as $index => $entry)
            <div class="leaderboard-item">
                <div class="rank rank-{{ $index < 3 ? $index + 1 : 'other' }}">{{ $index + 1 }}</div>
                <div class="profile-username">
                    {{ strtoupper(substr($entry->user->name, 0, 1)) }}{{ strtoupper(substr(explode(' ',
                    $entry->user->name)[1] ?? '', 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="username">{{ $entry->user->name }}</div>
                    @php
                    $levelLabels = [
                    'beginner' => 'Pemula',
                    'intermediate' => 'Menengah',
                    'advanced' => 'Mahir',
                    'expert' => 'Ahli',
                    'master' => 'Master'
                    ];
                    @endphp
                    <span class="user-level level-{{ $entry->level }}">
                        {{ $levelLabels[$entry->level] ?? 'Pemula' }}
                    </span>
                </div>
                <div class="score">
                    <div class="score-number">{{ number_format($entry->total_score) }}</div>
                    <div class="score-label">poin</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="cta-section">
        <div class="cta-icon"><i class="bi bi-trophy"></i></div>
        <h2 class="cta-title">Siap Menjadi Master Budaya?</h2>
        <p class="cta-subtitle">Mulai perjalanan quiz Anda dan raih peringkat tertinggi!</p>
        <button class="cta-btn" id="startQuiz">Mulai Quiz Sekarang</button>
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
