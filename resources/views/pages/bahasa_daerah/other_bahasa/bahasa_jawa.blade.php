@include('components.head')

@include('components.navbar')

<div class="container-other-bahasa">
    <button class="back-button-other-bahasa" onclick="window.history.back()">
        <i class="bi bi-chevron-left"></i>
        Kembali
    </button>

    <div class="main-grid-other-bahasa">
        <div>
            <div class="header-other-bahasa">
                <h1>Bahasa Jawa</h1>
                <p>Basa Jawa</p>
            </div>

            <div class="card card-other-bahasa">
                <div class="progress-header-other-bahasa">
                    <h2>Progress Pembelajaran</h2>
                    <span class="progress-percentage-other-bahasa">{{ $progress }}%</span>
                </div>
                <div class="progress-bar-container-other-bahasa">
                    <div class="progress-bar-other-bahasa" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            <div class="card lesson-list-other-bahasa">
                <h2>Daftar Pelajaran</h2>

                @foreach($lessons as $lesson)
                <div class="lesson-item-other-bahasa" onclick="window.location='{{ $lesson['route'] }}'">
                    <div class="lesson-content-other-bahasa">
                        <div
                            class="lesson-icon-other-bahasa {{ $lesson['completed'] ? 'completed' : 'not-completed' }}">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="lesson-info-other-bahasa">
                            <div class="lesson-title-other-bahasa">{{ $lesson['title'] }}</div>
                            <div class="lesson-status-other-bahasa">{{ $lesson['status'] }}</div>
                        </div>
                    </div>
                    @if($lesson['completed'])
                    <i class="bi bi-trophy trophy-icon-other-bahasa"></i>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <div>
            <div class="stats-card-other-bahasa">
                <h3>Statistik Anda</h3>
                <div class="stat-item-other-bahasa">
                    <span class="stat-label-other-bahasa">Pelajaran Selesai</span>
                    <span class="stat-value-other-bahasa">{{ $stats['completed_lessons'] }}</span>
                </div>
                <div class="stat-item-other-bahasa">
                    <span class="stat-label-other-bahasa">Waktu Belajar</span>
                    <span class="stat-value-other-bahasa">{{ $stats['study_time'] }}</span>
                </div>
                <div class="stat-item-other-bahasa">
                    <span class="stat-label-other-bahasa">Streak</span>
                    <span class="stat-value-other-bahasa">{{ $stats['streak'] }} <span class="fire-icon"><i
                                class="bi bi-fire"></i></span></span>
                </div>
            </div>

            <div class="audio-card-other-bahasa">
                <div class="audio-icon-other-bahasa"><i class="bi bi-volume-up"></i></div>
                <h3>Audio Native Speaker</h3>
                <p>Dengarkan pengucapan asli dari penutur native</p>
                <button class="audio-button-other-bahasa" onclick="openAudioModal()">Mulai Latihan Audio</button>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

<div class="audio-modal-overlay" id="audioModal">
    <div class="audio-modal">
        <div class="audio-modal-header">
            <div class="audio-modal-title">
                <i class="bi bi-volume-up-fill audio-speaker-icon"></i>
                <span>Latihan Mendengar</span>
            </div>
            <button class="audio-close-btn" onclick="closeAudioModal()">&times;</button>
        </div>

        <div class="audio-progress-container">
            <div class="audio-progress-label">
                <span>Progres</span>
                <span id="progressText">0/5</span>
            </div>
            <div class="audio-progress-bar">
                <div class="audio-progress-fill" id="progressFill"></div>
            </div>
        </div>

        <div class="audio-modal-content">
            <div class="audio-phase-label">Dengarkan dan ulangi</div>
            <div class="audio-main-phrase" id="mainPhrase">Selamat Pagi</div>
            <div class="audio-sub-phrase" id="subPhrase">Sugeng Enjang</div>
            <button class="audio-play-button" onclick="playAudio()">
                <div class="audio-play-icon"></div>
            </button>
        </div>

        <div class="audio-phrase-list">
            <div class="audio-phrase-item active" data-index="0">Selamat Pagi</div>
            <div class="audio-phrase-item" data-index="1">Selamat Siang</div>
            <div class="audio-phrase-item" data-index="2">Selamat Sore</div>
            <div class="audio-phrase-item" data-index="3">Selamat Malam</div>
        </div>

        <div class="audio-modal-footer">
            <button class="audio-footer-btn audio-skip-btn" onclick="closeAudioModal()">Lewati</button>
            <button class="audio-footer-btn audio-replay-btn" onclick="playAudio()">
                <i class="bi bi-arrow-clockwise"></i>
                Ulangi
            </button>
            <button class="audio-footer-btn audio-continue-btn" onclick="nextPhrase()">Lanjut</button>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function() {
            const progressBar = document.querySelector('.progress-bar-other-bahasa');
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.width = '65%';
            }, 300);
    });

    const audioPhrases = [
        { indo: 'Selamat Pagi', local: 'Sugeng Enjang' },
        { indo: 'Selamat Siang', local: 'Sugeng Siyang' },
        { indo: 'Selamat Sore', local: 'Sugeng Sonten' },
        { indo: 'Selamat Malam', local: 'Sugeng Dalu' },
    ];

    let currentPhraseIndex = 0;
    const totalPhrases = audioPhrases.length;

    function openAudioModal() {
        document.getElementById('audioModal').classList.add('show');
        currentPhraseIndex = 0;
        updateModalContent();
    }

    function closeAudioModal() {
        document.getElementById('audioModal').classList.remove('show');
        currentPhraseIndex = 0;
        updateProgress();
    }

    function playAudio() {
        console.log('Playing audio for:', audioPhrases[currentPhraseIndex]);
        const playButton = document.querySelector('.audio-play-button');
        playButton.style.transform = 'scale(0.95)';
        setTimeout(() => {
            playButton.style.transform = 'scale(1)';
        }, 200);
    }

    function nextPhrase() {
        if (currentPhraseIndex < totalPhrases - 1) {
            currentPhraseIndex++;
            updateModalContent();
        } else {
            alert('Selamat! Anda telah menyelesaikan semua latihan mendengar.');
            closeAudioModal();
        }
    }

    function updateModalContent() {
        const phrase = audioPhrases[currentPhraseIndex];
        document.getElementById('mainPhrase').textContent = phrase.indo;
        document.getElementById('subPhrase').textContent = phrase.local;
        updateProgress();
        updateActivePhrase();
    }

    function updateProgress() {
        const progress = ((currentPhraseIndex + 1) / totalPhrases) * 100;
        document.getElementById('progressFill').style.width = progress + '%';
        document.getElementById('progressText').textContent = `${currentPhraseIndex + 1}/${totalPhrases}`;
    }

    function updateActivePhrase() {
    const phraseItems = document.querySelectorAll('.audio-phrase-item');
    const phraseList = document.querySelector('.audio-phrase-list');
    
    phraseItems.forEach((item, index) => {
        if (index === currentPhraseIndex) {
            item.classList.add('active');
            
            if (window.innerWidth <= 768 && phraseList) {
                setTimeout(() => {
                    const itemOffsetLeft = item.offsetLeft;
                    const itemWidth = item.offsetWidth;
                    const containerWidth = phraseList.offsetWidth;
                    
                    const scrollPosition = itemOffsetLeft - (containerWidth / 2) + (itemWidth / 2);
                    
                    phraseList.scrollTo({
                        left: scrollPosition,
                        behavior: 'smooth'
                    });
                }, 50);
            }
        } else {
            item.classList.remove('active');
        }
    });
}

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.audio-phrase-item').forEach((item, index) => {
            item.addEventListener('click', function() {
                currentPhraseIndex = index;
                updateModalContent();
            });
        });

        document.querySelectorAll('.feature-card').forEach(card => {
            const icon = card.querySelector('.bi-volume-up');
            if (icon) {
                card.style.cursor = 'pointer';
                card.addEventListener('click', function() {
                    openAudioModal();
                });
            }
        });

        document.getElementById('audioModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAudioModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('audioModal');
            if (modal.classList.contains('show')) {
                if (e.key === 'Escape') {
                    closeAudioModal();
                } else if (e.key === 'ArrowRight' || e.key === 'Enter') {
                    nextPhrase();
                } else if (e.key === ' ') {
                    e.preventDefault();
                    playAudio();
                }
            }
        });
    });
</script>