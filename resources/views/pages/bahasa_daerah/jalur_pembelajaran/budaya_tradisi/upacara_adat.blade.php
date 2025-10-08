@include('components.head')

@include('components.navbar')

<div class="container-detail-rute">
    <a onclick="window.history.back()" class="back-link-detail-rute">Kembali ke Course</a>
    <div class="main-content-detail-rute">
        <h1>Upacar Adat</h1>

        <div class="progress-bar-container-detail-rute">
            <div class="progress-header-detail-rute">
                <span class="progress-label-detail-rute">Progress</span>
                <span class="progress-count-detail-rute">1 dari 3 pelajaran</span>
            </div>
            <div class="progress-bar-detail-rute"></div>
        </div>

        <div class="card-detail-rute">
            <div class="letter-display-detail-rute">
                <div class="letter-main-detail-rute">Siji</div>
                <div class="pronunciation-buttons-detail-rute">
                    <button class="pronunciation-btn-detail-rute" onclick="playSound('ah')">
                        <span><i class="bi bi-volume-up"></i></span> si-ji
                    </button>
                </div>
            </div>

            <div class="info-section-detail-rute">
                <div class="info-label-detail-rute">Arti</div>
                <div class="info-content-detail-rute">Satu (1)</div>
            </div>

            <div class="example-section-detail-rute">
                <div class="example-label-detail-rute">Contoh Penggunaan</div>
                <div class="example-content-detail-rute">Siji apel</div>
            </div>

            <button class="continue-btn-detail-rute" onclick="nextLesson()">Lanjut</button>

            <div class="tip-box-detail-rute">
                <span class="tip-icon-detail-rute">💡</span>
                <div class="tip-text-detail-rute">
                    <span class="tip-label-detail-rute">Tips:</span> Ulangi setiap kata beberapa kali untuk mengingat
                    dengan lebih
                    baik!
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

<script>
    function playSound(type) {
            console.log('Playing sound:', type);

            event.target.style.transform = 'scale(0.95)';
            setTimeout(() => {
                event.target.style.transform = 'scale(1)';
            }, 100);
            audio.play();
        }

        function nextLesson() {
            Simulasi perpindahan ke pelajaran berikutnya
             window.location.href = '/lesson/2';
        }

        window.addEventListener('load', () => {
            const card = document.querySelector('.card-detail-rute');
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
</script>
