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
                <h1>{{ $language->name }}</h1>
                <p>{{ $language->native_name }}</p>
            </div>

            <div class="card card-other-bahasa">
                <div class="progress-header-other-bahasa">
                    <h2>Progress Pembelajaran</h2>
                    <span class="progress-percentage-other-bahasa" id="progressPercentage">{{ round($progress)
                        }}%</span>
                </div>
                <div class="progress-bar-container-other-bahasa">
                    <div class="progress-bar-other-bahasa" id="progressBar" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            <div class="card lesson-list-other-bahasa" id="lessonList">
                <h2>Daftar Pelajaran</h2>

                @foreach($lessons as $lesson)
                <div class="lesson-item-other-bahasa"
                    onclick="navigateToLesson('{{ $lesson['route'] }}', {{ $lesson['id'] }})">
                    <div class="lesson-content-other-bahasa">
                        <div class="lesson-icon-other-bahasa {{ $lesson['completed'] ? 'completed' : 'not-completed' }}"
                            data-lesson-id="{{ $lesson['id'] }}">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="lesson-info-other-bahasa">
                            <div class="lesson-title-other-bahasa">{{ $lesson['title'] }}</div>
                            <div class="lesson-status-other-bahasa" data-status-id="{{ $lesson['id'] }}">{{
                                $lesson['status'] }}</div>
                        </div>
                    </div>
                    <i class="bi bi-trophy trophy-icon-other-bahasa" data-trophy-id="{{ $lesson['id'] }}"
                        style="display: {{ $lesson['completed'] ? 'block' : 'none' }}"></i>
                </div>
                @endforeach
            </div>
        </div>

        <div>
            <div class="stats-card-other-bahasa">
                <h3>Statistik Anda</h3>
                <div class="stat-item-other-bahasa">
                    <span class="stat-label-other-bahasa">Pelajaran Selesai</span>
                    <span class="stat-value-other-bahasa" id="completedLessons">{{ $stats['completed_lessons'] }}</span>
                </div>
                <div class="stat-item-other-bahasa">
                    <span class="stat-label-other-bahasa">Waktu Belajar</span>
                    <span class="stat-value-other-bahasa" id="studyTime">{{ $stats['study_time'] }}</span>
                </div>
                <div class="stat-item-other-bahasa">
                    <span class="stat-label-other-bahasa">Streak</span>
                    <span class="stat-value-other-bahasa" id="streak">{{ $stats['streak'] }} <span class="fire-icon"><i
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

<!-- Audio Modal -->
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
                <span id="progressText">0/0</span>
            </div>
            <div class="audio-progress-bar">
                <div class="audio-progress-fill" id="progressFill"></div>
            </div>
        </div>

        <div class="audio-modal-content">
            <div class="audio-phase-label">Dengarkan dan ulangi</div>
            <div class="audio-main-phrase" id="mainPhrase">Loading...</div>
            <div class="audio-sub-phrase" id="subPhrase">Loading...</div>
            <button class="audio-play-button" onclick="playAudio()">
                <div class="audio-play-icon"></div>
            </button>
        </div>

        <div class="audio-phrase-list" id="phraseList">
            <!-- Will be populated by JavaScript -->
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
    const languageId = {{ $language->id }};
let audioPhrases = [];
let currentPhraseIndex = 0;
let totalPhrases = 0;
let currentAudio = null;
let isRefreshing = false;

// Check if we need to refresh data (coming back from lesson page)
window.addEventListener('pageshow', function(event) {
    console.log('Page show event triggered');
    
    // Check for back/forward cache
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        console.log('Page loaded from cache, refreshing...');
        refreshProgressData();
    }
    
    // Also check sessionStorage
    const lessonCompleted = sessionStorage.getItem('lessonCompleted');
    if (lessonCompleted === 'true') {
        console.log('Lesson completion detected in pageshow, refreshing...');
        refreshProgressData();
    }
});

// Enhanced focus event with debouncing
let focusTimeout;
window.addEventListener('focus', function() {
    console.log('Window focus event');
    clearTimeout(focusTimeout);
    
    focusTimeout = setTimeout(() => {
        const lastActivity = sessionStorage.getItem('lessonCompleted');
        if (lastActivity === 'true') {
            console.log('Lesson completion detected, refreshing progress...');
            refreshProgressData();
        }
    }, 100);
});

// Enhanced visibility change detection
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        console.log('Page became visible');
        const lastActivity = sessionStorage.getItem('lessonCompleted');
        if (lastActivity === 'true') {
            console.log('Refreshing due to visibility change...');
            setTimeout(() => refreshProgressData(), 300);
        }
    }
});

window.addEventListener('load', function() {
    console.log('Page loaded');
    
    // Animate progress bar
    const progressBar = document.querySelector('.progress-bar-other-bahasa');
    if (progressBar) {
        progressBar.style.width = '0%';
        setTimeout(() => {
            progressBar.style.width = '{{ $progress }}%';
        }, 300);
    }

    // Check if coming back from lesson
    const lessonCompleted = sessionStorage.getItem('lessonCompleted');
    if (lessonCompleted === 'true') {
        console.log('Lesson completion detected on load, refreshing...');
        setTimeout(() => refreshProgressData(), 500);
    }
});

// Navigate to lesson and mark navigation
function navigateToLesson(route, lessonId) {
    console.log('Navigating to lesson:', lessonId);
    sessionStorage.setItem('currentLesson', lessonId);
    sessionStorage.setItem('fromLanguagePage', 'true');
    window.location.href = route;
}

// Refresh progress data from server with better error handling
async function refreshProgressData() {
    if (isRefreshing) {
        console.log('Already refreshing, skipping...');
        return;
    }
    
    isRefreshing = true;
    console.log('Starting progress refresh for language:', languageId);
    
    try {
        const response = await fetch(`/api/bahasa/${languageId}/progress`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            cache: 'no-cache' // Prevent caching
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Progress data received:', data);

        // Update progress bar with animation
        const progressBar = document.getElementById('progressBar');
        const progressPercentage = document.getElementById('progressPercentage');
        if (progressBar && progressPercentage) {
            progressBar.style.transition = 'width 0.5s ease-out';
            progressBar.style.width = data.progress + '%';
            progressPercentage.textContent = Math.round(data.progress) + '%';
        }

        // Update statistics
        const completedLessonsEl = document.getElementById('completedLessons');
        const studyTimeEl = document.getElementById('studyTime');
        const streakEl = document.getElementById('streak');
        
        if (completedLessonsEl) completedLessonsEl.textContent = data.stats.completed_lessons;
        if (studyTimeEl) studyTimeEl.textContent = data.stats.study_time;
        if (streakEl) {
            streakEl.innerHTML = data.stats.streak + ' <span class="fire-icon"><i class="bi bi-fire"></i></span>';
        }

        // Update lesson completion status with improved trophy animation
        if (data.lessons && Array.isArray(data.lessons)) {
            data.lessons.forEach(lesson => {
                const icon = document.querySelector(`.lesson-icon-other-bahasa[data-lesson-id="${lesson.id}"]`);
                const status = document.querySelector(`[data-status-id="${lesson.id}"]`);
                const trophy = document.querySelector(`[data-trophy-id="${lesson.id}"]`);

                if (icon) {
                    const wasCompleted = icon.classList.contains('completed');
                    
                    if (lesson.completed) {
                        icon.classList.remove('not-completed');
                        icon.classList.add('completed');
                    } else {
                        icon.classList.remove('completed');
                        icon.classList.add('not-completed');
                    }
                    
                    // If newly completed, add celebration animation
                    if (lesson.completed && !wasCompleted) {
                        icon.style.animation = 'iconBounce 0.6s ease-out';
                    }
                }

                if (status) {
                    status.textContent = lesson.status;
                }

                if (trophy) {
                    const wasVisible = trophy.style.display !== 'none';
                    trophy.style.display = lesson.completed ? 'block' : 'none';
                    
                    // If trophy just appeared, animate it
                    if (lesson.completed && !wasVisible) {
                        console.log('Showing trophy for lesson:', lesson.id);
                        trophy.style.animation = 'none';
                        // Force reflow
                        void trophy.offsetWidth;
                        trophy.style.animation = 'trophyBounce 0.8s ease-out';
                        
                        // Add sparkle effect
                        setTimeout(() => addSparkleEffect(trophy), 100);
                    }
                }
            });
        }

        // Clear session storage after successful refresh
        sessionStorage.removeItem('lessonCompleted');
        sessionStorage.removeItem('completedLessonId');
        sessionStorage.removeItem('completedLanguageId');
        

    } catch (error) {
        console.error('Error refreshing progress:', error);
        showMiniNotification('⚠ Gagal memperbarui data', 'warning');
    } finally {
        isRefreshing = false;
    }
}

// Add sparkle effect to trophy
function addSparkleEffect(element) {
    const sparkles = ['✨', '⭐', '🌟', '💫'];
    const rect = element.getBoundingClientRect();
    
    for (let i = 0; i < 4; i++) {
        const sparkle = document.createElement('div');
        sparkle.textContent = sparkles[i % sparkles.length];
        sparkle.style.cssText = `
            position: fixed;
            left: ${rect.left + rect.width / 2}px;
            top: ${rect.top + rect.height / 2}px;
            font-size: 1.5rem;
            pointer-events: none;
            z-index: 10000;
            animation: sparkleFloat ${0.8 + i * 0.2}s ease-out forwards;
        `;
        document.body.appendChild(sparkle);
        
        setTimeout(() => sparkle.remove(), 1000);
    }
}

async function loadAudioPhrases() {
    try {
        const response = await fetch(`/api/bahasa/${languageId}/audio-phrases`);
        const data = await response.json();
        audioPhrases = data;
        totalPhrases = audioPhrases.length;

        console.log('Loaded audio phrases:', audioPhrases); // Debug log

        const phraseList = document.getElementById('phraseList');
        phraseList.innerHTML = '';
        audioPhrases.forEach((phrase, index) => {
            const div = document.createElement('div');
            div.className = 'audio-phrase-item' + (index === 0 ? ' active' : '');
            div.setAttribute('data-index', index);
            div.textContent = phrase.indonesian;
            div.addEventListener('click', () => {
                currentPhraseIndex = index;
                updateModalContent();
            });
            phraseList.appendChild(div);
        });

        updateModalContent();
    } catch (error) {
        console.error('Error loading audio phrases:', error);
        // Show error in modal
        document.getElementById('mainPhrase').textContent = 'Error loading audio phrases';
        document.getElementById('subPhrase').textContent = 'Please try again later';
    }
}

function openAudioModal() {
    document.getElementById('audioModal').classList.add('show');
    currentPhraseIndex = 0;
    loadAudioPhrases();
}

function closeAudioModal() {
    if (currentAudio) {
        currentAudio.pause();
        currentAudio = null;
    }
    document.getElementById('audioModal').classList.remove('show');
    currentPhraseIndex = 0;
    updateProgress();
}

function playAudio() {
    if (audioPhrases.length === 0) return;

    const phrase = audioPhrases[currentPhraseIndex];
    console.log('Current phrase:', phrase); // Debug log

    if (currentAudio) {
        currentAudio.pause();
        currentAudio.currentTime = 0;
    }

    // Coba beberapa kemungkinan field name untuk audio
    const audioUrl = phrase.audio_url || phrase.audio_file;
    
    console.log('Trying to play audio from URL:', audioUrl); // Debug log

    if (audioUrl) {
        currentAudio = new Audio(audioUrl);
        
        currentAudio.onloadeddata = function() {
            console.log('Audio loaded successfully');
            currentAudio.play().catch(error => {
                console.error('Error playing audio:', error);
                showAudioError();
            });
        };
        
        currentAudio.onerror = function() {
            console.error('Error loading audio file');
            showAudioError();
        };
        
        currentAudio.oncanplaythrough = function() {
            console.log('Audio can play through');
        };
        
    } else {
        console.error('No audio URL available for phrase:', phrase);
        showAudioError();
    }

    // Add button animation
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
    if (audioPhrases.length === 0) return;

    const phrase = audioPhrases[currentPhraseIndex];
    document.getElementById('mainPhrase').textContent = phrase.indonesian;
    document.getElementById('subPhrase').textContent = phrase.local_language;
    updateProgress();
    updateActivePhrase();
}

function updateProgress() {
    if (totalPhrases === 0) return;

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

function showAudioError() {
    const mainPhrase = document.getElementById('mainPhrase');
    const originalText = mainPhrase.textContent;
    mainPhrase.textContent = 'Audio tidak tersedia';
    mainPhrase.style.color = '#ff6b6b';
    
    setTimeout(() => {
        mainPhrase.textContent = originalText;
        mainPhrase.style.color = '';
    }, 2000);
}

// Tambahkan event listener untuk tombol play saat modal terbuka
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    
    // Close modal on outside click
    document.getElementById('audioModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAudioModal();
        }
    });

    // Pastikan tombol play dapat diklik
    const playButton = document.querySelector('.audio-play-button');
    if (playButton) {
        playButton.style.cursor = 'pointer';
        playButton.addEventListener('click', playAudio);
    }

    // Keyboard shortcuts
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

// Add enhanced animations
const style = document.createElement('style');
style.textContent = `
    @keyframes trophyBounce {
        0% { 
            transform: scale(0) rotate(0deg);
            opacity: 0;
        }
        50% { 
            transform: scale(1.4) rotate(180deg);
            opacity: 1;
        }
        70% { 
            transform: scale(0.9) rotate(350deg);
        }
        85% { 
            transform: scale(1.1) rotate(365deg);
        }
        100% { 
            transform: scale(1) rotate(360deg);
            opacity: 1;
        }
    }
    
    @keyframes iconBounce {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.2) rotate(-5deg); }
        50% { transform: scale(1.15) rotate(5deg); }
        75% { transform: scale(1.2) rotate(-3deg); }
    }
    
    @keyframes sparkleFloat {
        0% {
            transform: translate(0, 0) scale(0);
            opacity: 1;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: translate(var(--tx), var(--ty)) scale(1);
            opacity: 0;
        }
    }
    
    @keyframes miniNotifSlide {
        from {
            transform: translate(-50%, -100%);
            opacity: 0;
        }
        to {
            transform: translate(-50%, 0);
            opacity: 1;
        }
    }
    
    .trophy-icon-other-bahasa {
        transition: all 0.3s ease;
    }
    
    .lesson-icon-other-bahasa {
        transition: all 0.3s ease;
    }
`;

// Generate random sparkle directions
for (let i = 0; i < 4; i++) {
    const angle = (i * 90) + 45;
    const tx = Math.cos(angle * Math.PI / 180) * 50;
    const ty = Math.sin(angle * Math.PI / 180) * 50;
    style.textContent += `
        @keyframes sparkleFloat:nth-child(${i + 1}) {
            --tx: ${tx}px;
            --ty: ${ty}px;
        }
    `;
}

document.head.appendChild(style);
</script>