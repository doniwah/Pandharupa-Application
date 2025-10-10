<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kelas->judul }}</title>
    <link rel="stylesheet" href="{{ asset('css') }}/navbar.css">
    <link rel="stylesheet" href="{{ asset('css') }}/footer.css">
    <link rel="stylesheet" href="{{ asset('css/pages') }}/kelas_detail.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>
    @include('components.navbar')

    <div class="page-container">
        <div class="container">

            <a href="{{ route('kelas.index') }}" class="back-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#4a5568">
                    <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z" />
                </svg> Kembali ke Beranda
            </a>


            <div class="course-header">
                <div class="course-icon-wrapper">
                    <div class="course-icon" style="color: #e67e22">{!! $kelas->icon !!}</div>
                </div>
                <div class="course-info">
                    <div class="course-badges">
                        <span class="badge badge-category">{{ $kelas->kategori }}</span>
                        <span class="badge badge-lessons">{{ $pelajaran->count() }} Pelajaran</span>
                        <span class="badge badge-duration">{{ $kelas->durasi }} minggu</span>
                    </div>
                    <h1 class="course-title">{{ $kelas->judul }}</h1>
                    <p class="course-description">{{ $kelas->deskripsi }}</p>
                    <div class="course-meta">
                        <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>Durasi: {{ $kelas->durasi }} minggu</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-book"></i>
                            <span>{{ $pelajaran->count() }} Materi Pembelajaran</span>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="section-title">Daftar Pelajaran</h2>
            <div class="lesson-list">
                @php
                    $completed = 0;
                @endphp
                @forelse($pelajaran as $index => $lesson)
                    @php
                        $isCompleted = false;
                        if (auth()->check()) {
                            $isCompleted = \App\Models\Progress::where('user_id', auth()->id())
                                ->where('pelajaran_id', $lesson->id)
                                ->where('status', 'selesai')
                                ->exists();
                            if ($isCompleted) {
                                $completed++;
                            }
                        }
                    @endphp

                    <a href="{{ route('kelas.baca', ['kelasId' => $kelas->id, 'pelajaranId' => $lesson->id]) }}"
                        class="lesson-card {{ $isCompleted ? 'completed' : '' }}"
                        data-lesson-id="{{ $lesson->id }}">
                        <div class="lesson-number">{{ $index + 1 }}</div>
                        <div class="lesson-content">
                            <h3 class="lesson-title">{{ $lesson->judul }}</h3>
                            <div class="lesson-duration">
                                <i class="bi bi-clock"></i>
                                <span>{{ $lesson->durasi }} menit</span>
                            </div>
                        </div>
                        @if ($isCompleted)
                            <div class="lesson-check">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        @endif
                    </a>
                @empty
                    <div class="no-lessons">
                        <p>Belum ada pelajaran tersedia untuk kelas ini.</p>
                    </div>
                @endforelse
            </div>


            @if ($pelajaran->count() > 0)
                <div class="progress-section" id="progressSection">
                    <div class="progress-number">
                        <span id="completedCount">{{ $completed }}</span> / <span
                            id="totalCount">{{ $pelajaran->count() }}</span>
                    </div>
                    <div class="progress-text">Pelajaran Diselesaikan</div>
                </div>
            @endif
        </div>
    </div>

    <script>
        @if (auth()->check())
            function updateProgressDisplay() {
                fetch('{{ route('kelas.progress', $kelas->id) }}', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('completedCount').textContent = data.data.completed;
                            document.getElementById('totalCount').textContent = data.data.total;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            document.addEventListener('DOMContentLoaded', updateProgressDisplay);
        @endif
    </script>
</body>

</html>
