@include('components.head')
@include('components.navbar')

<div class="container-detail-rute">
    <a href="{{ route('bahasa.learning_path', [$language->id, request()->route('pathId') ?? 1]) }}"
        class="back-link-detail-rute">
        Kembali ke Course
    </a>
    <div class="main-content-detail-rute">
        <h1>{{ $lesson->title }}</h1>

        <div class="progress-bar-container-detail-rute">
            <div class="progress-header-detail-rute">
                <span class="progress-label-detail-rute">Progress</span>
                <span class="progress-count-detail-rute" id="progress-text">Loading...</span>
            </div>
            <div class="progress-bar-detail-rute">
                <div class="progress-fill-detail-rute" id="progress-bar" style="width: 0%"></div>
            </div>
        </div>

        <div class="card-detail-rute" id="lesson-card">
            <div class="letter-display-detail-rute">
                <div class="letter-main-detail-rute" id="word-display">Loading...</div>
                <div class="pronunciation-buttons-detail-rute" id="pronunciation-buttons">
                    <!-- Buttons will be loaded dynamically -->
                </div>
            </div>

            <div class="info-section-detail-rute">
                <div class="info-label-detail-rute">Arti</div>
                <div class="info-content-detail-rute" id="meaning-display">Loading...</div>
            </div>

            <div class="example-section-detail-rute">
                <div class="example-label-detail-rute">Contoh Penggunaan</div>
                <div class="example-content-detail-rute" id="example-display">Loading...</div>
            </div>

            <button class="continue-btn-detail-rute" onclick="nextLesson()">Lanjut</button>

            <div class="tip-box-detail-rute">
                <span class="tip-icon-detail-rute">💡</span>
                <div class="tip-text-detail-rute">
                    <span class="tip-label-detail-rute">Tips:</span>
                    <span id="tip-text">Ulangi setiap kata beberapa kali untuk mengingat dengan lebih baik!</span>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

<script>
    const languageId = {{ $language->id }};
const lessonId = {{ $lesson->id }};
const pathId = {{ isset($pathId) && $pathId ? $pathId : 'null' }};

let lessonData = [];
let currentIndex = 0;
let currentAudio = null;
let startTime = Date.now();
let studyTime = 0;
let studyTimeInterval = null;
let hasCompleted = false;

// Start study time tracking
function startStudyTimeTracking() {
    startTime = Date.now();
    studyTimeInterval = setInterval(() => {
        studyTime = Math.floor((Date.now() - startTime) / 1000);
    }, 1000);
}

// Stop study time tracking
function stopStudyTimeTracking() {
    if (studyTimeInterval) {
        clearInterval(studyTimeInterval);
        studyTimeInterval = null;
    }
    studyTime = Math.floor((Date.now() - startTime) / 1000);
}

// Load lesson contents from API
async function loadLessonData() {
    try {
        const response = await fetch(`/api/bahasa/${languageId}/lesson/${lessonId}/contents`);
        lessonData = await response.json();
        
        if (lessonData.length === 0) {
            console.error('No lesson content found');
            lessonData = [{
                word: 'Konten Kosong',
                meaning: 'Belum ada konten untuk pelajaran ini',
                example: 'Silakan tambahkan konten melalui admin',
                pronunciations: [],
                tip: 'Hubungi administrator'
            }];
        }
        
        updateProgress();
        displayCurrentLesson();
    } catch (error) {
        console.error('Error loading lesson data:', error);
    }
}

function displayCurrentLesson() {
    const current = lessonData[currentIndex];
    
    // Update main content
    document.getElementById('word-display').textContent = current.word;
    document.getElementById('meaning-display').textContent = current.meaning;
    document.getElementById('example-display').textContent = current.example;
    document.getElementById('tip-text').textContent = current.tip || 'Ulangi setiap kata beberapa kali untuk mengingat dengan lebih baik!';

    // Update pronunciation buttons
    const buttonContainer = document.getElementById('pronunciation-buttons');
    buttonContainer.innerHTML = '';
    
    if (current.pronunciations && current.pronunciations.length > 0) {
        current.pronunciations.forEach(pron => {
            const button = document.createElement('button');
            button.className = 'pronunciation-btn-detail-rute';
            button.onclick = () => playSound(current.audio_url);
            button.innerHTML = `<span><i class="bi bi-volume-up"></i></span> ${pron.text}`;
            buttonContainer.appendChild(button);
        });
    }

    // Update button text based on position
    const continueBtn = document.querySelector('.continue-btn-detail-rute');
    if (currentIndex === lessonData.length - 1) {
        continueBtn.textContent = 'Selesai';
        continueBtn.onclick = completeLesson;
    } else {
        continueBtn.textContent = 'Lanjut';
        continueBtn.onclick = nextLesson;
    }

    // Animation
    animateCard();
}

function updateProgress() {
    const progressText = `${currentIndex + 1} dari ${lessonData.length} pelajaran`;
    const progressPercent = ((currentIndex + 1) / lessonData.length) * 100;
    
    document.getElementById('progress-text').textContent = progressText;
    document.getElementById('progress-bar').style.width = progressPercent + '%';
}

function playSound(audioUrl) {
    if (!audioUrl) {
        console.log('No audio available');
        return;
    }

    if (currentAudio) {
        currentAudio.pause();
    }
    
    currentAudio = new Audio(audioUrl);
    currentAudio.play().catch(error => {
        console.error('Error playing audio:', error);
    });

    // Visual feedback
    if (event && event.target) {
        event.target.style.transform = 'scale(0.95)';
        setTimeout(() => {
            event.target.style.transform = 'scale(1)';
        }, 100);
    }
}

function nextLesson() {
    if (currentIndex < lessonData.length - 1) {
        currentIndex++;
        updateProgress();
        displayCurrentLesson();
    }
}

async function completeLesson() {
    if (hasCompleted) {
        alert('Anda sudah menyelesaikan pelajaran ini!');
        redirectToLearningPath();
        return;
    }

    // Validate pathId exists
    if (!pathId || pathId === 'null' || pathId === null) {
        console.error('PathId is invalid!', pathId);
        alert('Error: PathId tidak ditemukan. Tidak dapat menyimpan progress.');
        return;
    }

    // Stop study time tracking
    stopStudyTimeTracking();
    
    const studyTimeMinutes = Math.ceil(studyTime / 60);

    // Disable button to prevent double click
    const continueBtn = document.querySelector('.continue-btn-detail-rute');
    const originalText = continueBtn.textContent;
    continueBtn.disabled = true;
    continueBtn.textContent = 'Menyimpan...';
    continueBtn.style.opacity = '0.6';
    continueBtn.style.cursor = 'not-allowed';

    try {
        const response = await fetch(`/api/bahasa/${languageId}/lesson/${lessonId}/complete`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                study_time: studyTimeMinutes,
                actual_seconds: studyTime,
                completion_type: 'button'
            })
        });

        const result = await response.json();
        
        if (result.success) {
            hasCompleted = true;
            console.log('=== LESSON COMPLETED ===');
            console.log('Lesson completed successfully!');
            console.log('Study time:', studyTime, 'seconds');
            console.log('Setting pathId to sessionStorage:', pathId);
            
            // PENTING: Set flag dengan pathId yang VALID
            sessionStorage.setItem('lessonJustCompleted', 'true');
            sessionStorage.setItem('completedLessonId', lessonId.toString());
            sessionStorage.setItem('completedLanguageId', languageId.toString());
            sessionStorage.setItem('completedPathId', pathId.toString());
            
            // VERIFY: Check apakah tersimpan
            console.log('Verification - Stored values:');
            console.log('- lessonJustCompleted:', sessionStorage.getItem('lessonJustCompleted'));
            console.log('- completedPathId:', sessionStorage.getItem('completedPathId'));
            console.log('- completedLessonId:', sessionStorage.getItem('completedLessonId'));
            
            // Show success message
            showSuccessNotification(result.message || 'Selamat! Anda telah menyelesaikan pelajaran ini.');
            
            // Wait 2 seconds then redirect
            setTimeout(() => {
                console.log('Redirecting to learning path...');
                redirectToLearningPath();
            }, 2000);
            
        } else {
            throw new Error(result.message || 'Gagal menyelesaikan pelajaran');
        }
    } catch (error) {
        console.error('Error completing lesson:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
        
        // Re-enable button
        continueBtn.disabled = false;
        continueBtn.textContent = originalText;
        continueBtn.style.opacity = '1';
        continueBtn.style.cursor = 'pointer';
        
        // Restart tracking if failed
        startStudyTimeTracking();
    }
}

// Show success notification - PERBAIKAN: Lebih kecil dan warna hijau
function showSuccessNotification(message) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
        z-index: 10000;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.9rem;
        animation: slideInRight 0.4s ease-out;
        max-width: 320px;
    `;
    
    notification.innerHTML = `
        <i class="bi bi-check-circle-fill" style="font-size: 1.2rem;"></i>
        <div>
            <strong style="display: block; font-weight: 600; font-size: 0.9rem;">Selesai!</strong>
            <span style="font-size: 0.85rem; opacity: 0.95;">${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Add animation styles
    if (!document.getElementById('notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    // Remove after 2.5 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.4s ease-in';
        setTimeout(() => notification.remove(), 400);
    }, 2500);
}

// Redirect to learning path
function redirectToLearningPath() {
    if (pathId && pathId !== 'null') {
        window.location.href = `/bahasa/${languageId}/path/${pathId}`;
    } else {
        window.history.back();
    }
}

function animateCard() {
    const card = document.getElementById('lesson-card');
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';

    setTimeout(() => {
        card.style.transition = 'all 0.5s ease';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, 100);
}

// Initialize on page load
window.addEventListener('load', () => {
    startStudyTimeTracking();
    loadLessonData();
});

// Stop tracking when leaving page
window.addEventListener('beforeunload', () => {
    stopStudyTimeTracking();
});

// Handle visibility change
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        stopStudyTimeTracking();
    } else if (!hasCompleted) {
        startStudyTimeTracking();
    }
});
</script>