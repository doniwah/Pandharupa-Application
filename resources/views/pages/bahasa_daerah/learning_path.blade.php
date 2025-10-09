@include('components.head')
@include('components.navbar')

<div class="container-rute-learn">
    <a onclick="window.history.back()" class="back-btn-rute-learn">
        <i class="bi bi-chevron-left"></i> Kembali
    </a>

    <div class="content-rute-learn">
        <div class="main-content-dasar">
            <div class="header-rute-learn">
                <div class="badge-rute-learn">{{ $learningPath->level }}</div>
                <h1>{{ $learningPath->name }}</h1>
                <p>{{ $learningPath->description }}</p>
            </div>

            <div class="progress-section-rute-learn">
                <div class="progress-header-rute-learn">
                    <h2>Progress Jalur</h2>
                    <span class="progress-count-rute-learn">{{ $completedLessons }}/{{ $totalLessons }} Selesai</span>
                </div>

                <div class="topic-list-rute-learn">
                    @foreach($lessons as $lesson)
                    <div class="topic-item-rute-learn" data-route="{{ $lesson['route'] }}">
                        <div class="status-icon-rute-learn {{ $lesson['completed'] ? 'completed' : '' }}"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">{{ $lesson['title'] }}</div>
                            <div class="topic-subtitle-rute-learn">{{ $lesson['status'] }}</div>
                        </div>
                        <div class="topic-action-rute-learn">Mulai <i class="bi bi-chevron-right"></i></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

<script>
    document.querySelectorAll('.topic-item-rute-learn').forEach(item => {
        item.style.cursor = 'pointer';

        item.addEventListener('click', function() {
            const route = this.getAttribute('data-route');
            if (route) {
                window.location.href = route;
            }
        });
    });

    const languageId = {{ $language->id }};
    const pathId = {{ $learningPath->id }};

    // Backup checks (kalau immediate check terlewat)
    window.addEventListener('load', function() {
        console.log('Window load event, checking completion...');
        setTimeout(checkCompletionAndRefresh, 100);
    });

    // Check on page visibility change
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            console.log('Page visible, checking completion...');
            checkCompletionAndRefresh();
        }
    });

    // Check on focus
    window.addEventListener('focus', function() {
        console.log('Page focused, checking completion...');
        checkCompletionAndRefresh();
    });

    async function checkCompletionAndRefresh() {
        const lessonJustCompleted = sessionStorage.getItem('lessonJustCompleted');
        const completedPathId = sessionStorage.getItem('completedPathId');
        
        console.log('=== BACKUP CHECK ===');
        console.log('Flags:', {
            lessonJustCompleted,
            completedPathId,
            currentPathId: pathId
        });
        
        // Kalau flags sudah tidak ada, berarti sudah di-handle immediate check
        if (!lessonJustCompleted) {
            console.log('No flags found (already handled)');
            return;
        }
        
        if (lessonJustCompleted === 'true' && completedPathId == pathId) {
            console.log('✅ BACKUP: Path ID matches! Refreshing...');
            
            // Clear flags
            sessionStorage.removeItem('lessonJustCompleted');
            sessionStorage.removeItem('completedLessonId');
            sessionStorage.removeItem('completedLanguageId');
            sessionStorage.removeItem('completedPathId');
            // Reload
            setTimeout(() => {
                window.location.reload();
            }, 800);
        }
    }

</script>