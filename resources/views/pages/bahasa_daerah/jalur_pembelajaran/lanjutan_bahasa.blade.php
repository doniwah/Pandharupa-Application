@include('components.head')

@include('components.navbar')

<div class="container-rute-learn">
    <a href="#" class="back-btn-rute-learn" onclick="history.back(); return false;"><i class="bi bi-chevron-left"></i>
        Kembali</a>

    <div class="content-rute-learn">
        <div class="main-content-dasar">
            <div class="header-rute-learn">
                <div class="badge-rute-learn">Lanjutan</div>
                <h1>Budaya dan Tradisi</h1>
                <p>Pelajari aspek budaya dan tradisi lokal</p>
            </div>

            <div class="progress-section-rute-learn">
                <div class="progress-header-rute-learn">
                    <h2>Progress Jalur</h2>
                    <span class="progress-count-rute-learn">0/4 Selesai</span>
                </div>

                <div class="topic-list-rute-learn">
                    <div class="topic-item-rute-learn" data-route="{{ route('upacara-adat.bahasa') }}">
                        <div class="status-icon-rute-learn completed"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">Upacara Adat</div>
                            <div class="topic-subtitle-rute-learn">Selesai</div>
                        </div>
                        <div class="topic-action-rute-learn">Mulai <i class="bi bi-chevron-right"></i></div>
                    </div>

                    <div class="topic-item-rute-learn" data-route="{{ route('cerita-rakyat.bahasa') }}">
                        <div class="status-icon-rute-learn"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">Cerita Rakyat</div>
                            <div class="topic-subtitle-rute-learn">Topik 2</div>
                        </div>
                        <div class="topic-action-rute-learn">Mulai <i class="bi bi-chevron-right"></i></div>
                    </div>

                    <div class="topic-item-rute-learn" data-route="{{ route('pantun-puisi-lanjutan.bahasa') }}">
                        <div class="status-icon-rute-learn"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">Pantun dan Puisi</div>
                            <div class="topic-subtitle-rute-learn">Topik 3</div>
                        </div>
                        <div class="topic-action-rute-learn">Mulai <i class="bi bi-chevron-right"></i></div>
                    </div>

                    <div class="topic-item-rute-learn" data-route="{{ route('percakapan-formal-lanjutan.bahasa') }}">
                        <div class="status-icon-rute-learn"></div>
                        <div class="topic-content-rute-learn">
                            <div class="topic-title-rute-learn">Percakapan Formal</div>
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