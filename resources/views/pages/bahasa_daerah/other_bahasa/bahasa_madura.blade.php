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
                <h1>Bahasa Madura</h1>
                <p>Basa Madhura</p>
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
                <div class="lesson-item-other-bahasa">
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
                <button class="audio-button-other-bahasa" onclick="playAudio()">Mulai Latihan Audio</button>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

<script>
    function playAudio() {
            alert('Fitur audio akan segera tersedia!');
        }

        window.addEventListener('load', function() {
            const progressBar = document.querySelector('.progress-bar-other-bahasa');
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.width = '65%';
            }, 300);
        });
</script>
