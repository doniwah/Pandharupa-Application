@include('components.head')

@include('components.navbar')

<div class="container-detail-bahasa">
    <a class="back-button-detail-bahasa" onclick="window.history.back()">Kembali</a>

    <div class="content-detail-bahasa">
        <div class="content-card-detail-bahasa" id="lessonContent">
            <h1>{{ $lesson->title }}</h1>

            <div class="divider-detail-bahasa"></div>

            <!-- Render lesson content dynamically -->
            {!! $lesson->content !!}

            <div style="margin-top: 2rem;">
                <a onclick="window.history.back()" class="return-button-detail-bahasa">
                    Kembali ke Daftar Pelajaran
                </a>
            </div>

            <!-- Invisible marker at the bottom -->
            <div id="bottomMarker" style="height: 1px;"></div>
        </div>
    </div>
</div>

<!-- Progress Indicator -->
<div id="readingProgress" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: rgba(0, 123, 255, 0.9);
    color: white;
    padding: 0.75rem 1.25rem;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    display: none;
    align-items: center;
    gap: 0.5rem;
    z-index: 1000;
    animation: fadeIn 0.3s ease-out;
">
    <i class="bi bi-book"></i>
    <span id="progressText">Membaca... <strong>0%</strong></span>
</div>

@include('components.footer')

<script>
    const languageId = {{ $language->id }};
const lessonId = {{ $lesson->id }};
let hasCompleted = false;
let isProcessing = false;
let scrollProgressTimeout;
let startTime = Date.now();
let studyTime = 0;
let studyTimeInterval = null;

// Check if lesson was already completed before
let wasAlreadyCompleted = false;

// Intersection Observer for bottom detection
const bottomMarker = document.getElementById('bottomMarker');
const progressIndicator = document.getElementById('readingProgress');
const progressText = document.getElementById('progressText');
const lessonContent = document.getElementById('lessonContent');

// Start study time tracking
function startStudyTimeTracking() {
    startTime = Date.now();
    studyTimeInterval = setInterval(() => {
        studyTime = Math.floor((Date.now() - startTime) / 1000); // in seconds
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

// Format time for display
function formatTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
    
    if (hours > 0) {
        return `${hours} jam ${minutes} menit`;
    } else if (minutes > 0) {
        return `${minutes} menit ${secs} detik`;
    } else {
        return `${secs} detik`;
    }
}

// Check if lesson is already completed on page load
async function checkInitialCompletion() {
    try {
        const response = await fetch(`/api/bahasa/${languageId}/lessons/${lessonId}/status`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();
        
        if (data.completed) {
            wasAlreadyCompleted = true;
            hasCompleted = true;
            
            // Show completed state immediately
            progressIndicator.style.display = 'flex';
            progressIndicator.style.background = 'rgba(40, 167, 69, 0.9)';
            progressText.innerHTML = '<i class="bi bi-check-circle-fill"></i> <strong>Sudah Selesai</strong>';
            
            console.log('Lesson was already completed');
        }
    } catch (error) {
        console.error('Error checking completion status:', error);
    }
}

// Calculate scroll progress
function updateScrollProgress() {
    // If already completed, keep the completion message
    if (hasCompleted) {
        progressIndicator.style.display = 'flex';
        progressIndicator.style.background = 'rgba(40, 167, 69, 0.9)';
        
        if (wasAlreadyCompleted) {
            progressText.innerHTML = '<i class="bi bi-check-circle-fill"></i> <strong>Sudah Selesai</strong>';
        } else {
            progressText.innerHTML = '<i class="bi bi-check-circle-fill"></i> <strong>Pelajaran Selesai!</strong>';
        }
        return 100;
    }
    
    const windowHeight = window.innerHeight;
    const documentHeight = lessonContent.offsetHeight;
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Calculate percentage - better calculation for small content
    const scrollableHeight = Math.max(documentHeight - windowHeight, 1);
    let scrollPercentage = Math.min(Math.round((scrollTop / scrollableHeight) * 100), 100);
    
    // For very short content, use different calculation
    if (documentHeight - windowHeight < 200) {
        const totalHeight = document.documentElement.scrollHeight;
        const scrolled = window.scrollY + window.innerHeight;
        scrollPercentage = Math.min(Math.round((scrolled / totalHeight) * 100), 100);
    }

    // Show progress indicator when scrolling
    if (scrollPercentage > 5 && scrollPercentage < 90) {
        progressIndicator.style.display = 'flex';
        progressIndicator.style.background = 'rgba(0, 123, 255, 0.9)';
        progressText.innerHTML = `Membaca... <strong>${scrollPercentage}%</strong>`;
    } else if (scrollPercentage >= 90 && !hasCompleted) {
        progressIndicator.style.display = 'flex';
        progressIndicator.style.background = 'rgba(255, 193, 7, 0.9)';
        progressText.innerHTML = '<i class="bi bi-hourglass-split"></i> <strong>Hampir selesai...</strong>';
    } else if (scrollPercentage <= 5) {
        progressIndicator.style.display = 'none';
    }

    return scrollPercentage;
}

// Observer for bottom marker - improved detection
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !hasCompleted && !isProcessing) {
            console.log('Bottom marker visible, marking as completed...');
            markAsCompleted();
        }
    });
}, {
    threshold: [0, 0.1, 0.5, 1.0],
    rootMargin: '0px 0px -50px 0px'
});

observer.observe(bottomMarker);

// Additional scroll-based completion for short content
let scrollCheckTimeout;
window.addEventListener('scroll', () => {
    clearTimeout(scrollCheckTimeout);
    clearTimeout(scrollProgressTimeout);
    
    scrollCheckTimeout = setTimeout(() => {
        const scrollPercentage = updateScrollProgress();
        
        // Auto-complete if scrolled to 95% or more
        if (scrollPercentage >= 95 && !hasCompleted && !isProcessing) {
            console.log('Scroll threshold reached (95%), marking as completed...');
            markAsCompleted();
        }
    }, 100);
    
    scrollProgressTimeout = setTimeout(() => {
        updateScrollProgress();
    }, 50);
});

// Mark as completed immediately when page loads for very short content
window.addEventListener('load', () => {
    // Start study time tracking
    startStudyTimeTracking();
    
    // Check if already completed
    checkInitialCompletion();
    
    setTimeout(() => {
        const documentHeight = lessonContent.offsetHeight;
        const windowHeight = window.innerHeight;
        
        // If content is shorter than viewport
        if (documentHeight - windowHeight < 300 && !wasAlreadyCompleted) {
            console.log('Content is very short, using alternative completion detection');
            
            const shortContentCheck = setInterval(() => {
                if (hasCompleted) {
                    clearInterval(shortContentCheck);
                    return;
                }
                
                const scrollPercentage = updateScrollProgress();
                if (scrollPercentage >= 80 && !hasCompleted && !isProcessing) {
                    clearInterval(shortContentCheck);
                    markAsCompleted();
                }
            }, 500);
            
            setTimeout(() => clearInterval(shortContentCheck), 30000);
        }
    }, 500);
});

// Stop tracking when leaving page
window.addEventListener('beforeunload', () => {
    stopStudyTimeTracking();
});

// Also stop on visibility change
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        stopStudyTimeTracking();
    } else if (!hasCompleted) {
        startStudyTimeTracking();
    }
});

async function markAsCompleted() {
    if (hasCompleted || isProcessing || wasAlreadyCompleted) {
        console.log('Already completed or processing, skipping...');
        return;
    }
    
    console.log('Starting completion process...');
    isProcessing = true;
    
    // Stop study time tracking
    stopStudyTimeTracking();
    
    // Calculate study time in minutes for backend
    const studyTimeMinutes = Math.ceil(studyTime / 60);

    // Show immediate visual feedback
    progressIndicator.style.display = 'flex';
    progressIndicator.style.background = 'rgba(255, 193, 7, 0.9)';
    progressText.innerHTML = '<i class="bi bi-hourglass-split"></i> <strong>Menyimpan...</strong>';

    try {
        const response = await fetch(`/api/bahasa/${languageId}/lessons/${lessonId}/complete`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                study_time: studyTimeMinutes, // Send study time in minutes
                actual_seconds: studyTime // Send actual seconds for logging
            })
        });

        const data = await response.json();
        console.log('Completion response:', data);

        if (data.success) {
            hasCompleted = true;
            console.log('Lesson marked as completed successfully!');
            console.log('Study time:', formatTime(studyTime));
            
            // Lock the completion state - this will never change
            progressIndicator.style.background = 'rgba(40, 167, 69, 0.9)';
            progressText.innerHTML = '<i class="bi bi-check-circle-fill"></i> <strong>Pelajaran Selesai!</strong>';
            
            
            // Mark that lesson was completed
            sessionStorage.setItem('lessonCompleted', 'true');
            sessionStorage.setItem('completedLessonId', lessonId);
            sessionStorage.setItem('completedLanguageId', languageId);
            sessionStorage.setItem('studyTime', studyTime);
            
            // Add pulse animation
            setTimeout(() => {
                progressIndicator.style.animation = 'pulse 1.5s infinite';
            }, 1000);
            
        } else {
            throw new Error(data.message || 'Gagal menyelesaikan pelajaran');
        }
    } catch (error) {
        console.error('Error completing lesson:', error);
        showNotification('Terjadi kesalahan saat menyimpan progres. Silakan coba lagi.', 'error');
        hasCompleted = false;
        
        // Restart study time tracking if failed
        startStudyTimeTracking();
        
        // Reset progress indicator
        progressIndicator.style.background = 'rgba(0, 123, 255, 0.9)';
        updateScrollProgress();
    } finally {
        isProcessing = false;
    }
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.9;
        }
    }

    #readingProgress {
        transition: background 0.3s ease, transform 0.2s ease;
        cursor: pointer;
    }

    #readingProgress:hover {
        transform: scale(1.05);
    }

    .notification div {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .notification small {
        opacity: 0.9;
        font-size: 0.85rem;
    }

    @media (max-width: 768px) {
        #readingProgress {
            bottom: 10px;
            right: 10px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        
        .notification {
            right: 10px;
            top: 10px;
            max-width: calc(100vw - 40px);
        }
    }
`;
document.head.appendChild(style);

// Force initial progress check
setTimeout(() => {
    updateScrollProgress();
}, 1000);

</script>