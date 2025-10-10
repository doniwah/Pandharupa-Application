<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pelajaran->judul }} - {{ $kelas->judul }}</title>
    <link rel="stylesheet" href="{{ asset('css') }}/navbar.css">
    <link rel="stylesheet" href="{{ asset('css') }}/footer.css">
    <link rel="stylesheet" href="{{ asset('css/pages') }}/baca_pelajaran.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    @include('components.navbar')

    <div class="page-container">
        <div class="container">

            <a href="{{ route('kelas.show', $kelas->id) }}" class="back-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#4a5568">
                    <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z" />
                </svg> Kembali ke Kursus
            </a>


            <div class="content-card">

                <div class="lesson-meta">
                    Pelajaran {{ $pelajaran->urutan }} dari {{ $kelas->pelajaran->count() }}
                </div>


                <h1 class="lesson-title">{{ $pelajaran->judul }}</h1>

                <div class="lesson-info">
                    <i class="bi bi-clock"></i>
                    <span>{{ $pelajaran->durasi }} menit</span>
                </div>


                <div class="lesson-content">
                    {!! nl2br(e($pelajaran->deskripsi)) !!}
                </div>
            </div>


            <div class="navigation-section">
                <div>
                    <a href="{{ route('kelas.show', $kelas->id) }}" class="nav-button btn-back">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#4a5568">
                            <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z" />
                        </svg> Daftar Pelajaran
                    </a>
                </div>
                <div>
                    <button class="nav-button btn-complete" id="markComplete">
                        <i class="bi bi-check-circle"></i> Tandai Selesai
                    </button>
                    @if ($next)
                        <a href="#" class="nav-button btn-next" id="nextLessonBtn"
                            data-next-url="{{ route('kelas.baca', ['kelasId' => $kelas->id, 'pelajaranId' => $next->id]) }}">
                            Pelajaran Selanjutnya <i class="bi bi-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>


            @if ($next)
                <div class="next-lesson-card">
                    <div class="next-label">Selanjutnya:</div>
                    <h3 class="next-title">{{ $next->judul }}</h3>
                    <div class="next-duration">
                        <i class="bi bi-clock"></i>
                        <span>{{ $next->durasi }} menit</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('markComplete')?.addEventListener('click', function() {
            const button = this;
            const originalText = button.innerHTML;

            button.disabled = true;
            button.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';

            fetch('{{ route('kelas.mark-complete', ['kelasId' => $kelas->id, 'pelajaranId' => $pelajaran->id]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        pelajaran_id: {{ $pelajaran->id }}
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.innerHTML = '<i class="bi bi-check-circle-fill"></i> Selesai';
                        button.classList.add('completed');

                        showNotification('Pelajaran berhasil ditandai selesai!', 'success');

                        @if ($next)
                            setTimeout(() => {
                                window.location.href =
                                    '{{ route('kelas.baca', ['kelasId' => $kelas->id, 'pelajaranId' => $next->id]) }}';
                            }, 1500);
                        @endif
                    } else {
                        button.innerHTML = originalText;
                        button.disabled = false;
                        showNotification(data.message || 'Gagal menyimpan progress', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    button.innerHTML = originalText;
                    button.disabled = false;
                    showNotification('Terjadi kesalahan', 'error');
                });
        });


        @if (auth()->check())
            window.addEventListener('load', function() {
                fetch('{{ route('kelas.update-progress', ['kelasId' => $kelas->id, 'pelajaranId' => $pelajaran->id]) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status: 'sedang_belajar'
                        })
                    })
                    .then(response => response.json())
                    .then(data => console.log('Progress updated:', data))
                    .catch(error => console.error('Error:', error));
            });
        @endif

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML =
                `<i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'x-circle-fill'}"></i> ${message}`;
            document.body.appendChild(notification);

            setTimeout(() => notification.classList.add('show'), 100);
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>
</body>

</html>
