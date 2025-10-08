@include('components.head')

@include('components.navbar')

<div class="container-rute-learn">
    <a href="#" class="back-btn-rute-learn" onclick="history.back(); return false;"><i class="bi bi-chevron-left"></i>
        Kembali</a>

    <div class="content-rute-learn">
        <div class="main-content-dasar">
            <div class="header-rute-learn">
                <div class="badge-rute-learn">Pemula</div>
                <h1>Dasar-Dasar Bahasa</h1>
                <p>Pelajari fondasi bahasa daerah dari awal</p>
            </div>

            <div class="progress-section-rute-learn">
                <div class="progress-header-rute-learn">
                    <h2>Progress Jalur</h2>
                    <span class="progress-count-rute-learn">1/4 Selesai</span>
                </div>

                <div class="topic-list-rute-learn">
                    <div class="topic-item-rute-learn" data-route="{{ route('pengenalan-huruf.bahasa') }}">
                        <div class="status-icon-rute-learn completed"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">Pengenalan Huruf dan Suara</div>
                            <div class="topic-subtitle-rute-learn">Selesai</div>
                        </div>
                        <div class="topic-action-rute-learn">Mulai <i class="bi bi-chevron-right"></i></div>
                    </div>

                    <div class="topic-item-rute-learn" data-route="{{ route('kosakata-sehari.bahasa') }}">
                        <div class="status-icon-rute-learn"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">Kosakata Sehari-hari</div>
                            <div class="topic-subtitle-rute-learn">Topik 2</div>
                        </div>
                        <div class="topic-action-rute-learn">Mulai <i class="bi bi-chevron-right"></i></div>
                    </div>

                    <div class="topic-item-rute-learn" data-route="{{ route('angka-waktu.bahasa') }}">
                        <div class="status-icon-rute-learn"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">Angka dan Waktu</div>
                            <div class="topic-subtitle-rute-learn">Topik 3</div>
                        </div>
                        <div class="topic-action-rute-learn">Mulai <i class="bi bi-chevron-right"></i></div>
                    </div>

                    <div class="topic-item-rute-learn" data-route="{{ route('keluarga-dan-profesi.bahasa') }}">
                        <div class="status-icon-rute-learn"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">Keluarga dan Profesi</div>
                            <div class="topic-subtitle-rute-learn">Topik 4</div>
                        </div>
                        <div class="topic-action-rute-learn">Mulai <i class="bi bi-chevron-right"></i></div>
                    </div>
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
        const topic = this.getAttribute('data-topic');

        if (route) {
            window.location.href = route;
        } else if (topic) {
            startTopic(parseInt(topic));
        }
    });
});

</script>