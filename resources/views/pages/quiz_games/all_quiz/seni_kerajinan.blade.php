@include('components.head')

@include('components.navbar')

<div class="container-all-quiz">
    <button class="back-button-all-quiz" onclick="window.history.back()">
        <i class="bi bi-chevron-left"></i>
        Kembali
    </button>

    <div class="main-content-all-quiz">
        <div class="progress-card-all-quiz">
            <div class="progress-header-all-quiz">
                <div class="title-section-all-quiz">
                    <h1>Seni dan Kerajinan</h1>
                    <span class="difficulty-badge-all-quiz badge-sedang">Sedang</span>
                </div>
                <div class="progress-info-all-quiz">
                    <div class="progress-label-all-quiz">Progress</div>
                    <div class="progress-percentage-all-quiz">33%</div>
                </div>
            </div>
            <div class="quiz-meta-all-quiz">
                <span>Pertanyaan 1 dari 3</span>
                <span>⏱ 10:00</span>
            </div>
            <div class="progress-bar-all-quiz">
                <div class="progress-fill-all-quiz" id="progressFill" style="width: 33%"></div>
            </div>
        </div>

        <div class="question-card-all-quiz">
            <div class="question-body-all-quiz">
                <div class="question-number-all-quiz">1</div>
                <div class="question-text-all-quiz">
                    Apa nama tarian tradisional khas Banyuwangi yang menggunakan properti payung?
                </div>
            </div>

            <div class="options-all-quiz">
                <div class="option-all-quiz" data-option="a">
                    <div class="option-radio-all-quiz"></div>
                    <div class="option-text-all-quiz">Tari Gandrung</div>
                    <div class="check-icon-all-quiz">✓</div>
                </div>

                <div class="option-all-quiz" data-option="b">
                    <div class="option-radio-all-quiz"></div>
                    <div class="option-text-all-quiz">Tari Seblang</div>
                    <div class="check-icon-all-quiz">✓</div>
                </div>

                <div class="option-all-quiz" data-option="c">
                    <div class="option-radio-all-quiz"></div>
                    <div class="option-text-all-quiz">Tari Jejer</div>
                    <div class="check-icon-all-quiz">✓</div>
                </div>

                <div class="option-all-quiz" data-option="d">
                    <div class="option-radio-all-quiz"></div>
                    <div class="option-text-all-quiz">Tari Angklung Caruk</div>
                    <div class="check-icon-all-quiz">✓</div>
                </div>
            </div>

            <div class="navigation-buttons-all-quiz">
                <button class="nav-btn-all-quiz btn-prev-all-quiz">← Sebelumnya</button>
                <button class="nav-btn-all-quiz btn-next-all-quiz">Selanjutnya →</button>
            </div>
        </div>

        <div class="question-nav-all-quiz">
            <div class="nav-title-all-quiz">Navigasi Soal</div>
            <div class="nav-numbers-all-quiz">
                <button class="nav-number-all-quiz active">1</button>
                <button class="nav-number-all-quiz">2</button>
                <button class="nav-number-all-quiz">3</button>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay-all-quiz" id="quizModal">
    <div class="modal-content-all-quiz">
        <div class="trophy-icon-all-quiz"><i class="bi bi-trophy"></i></div>
        <h2 class="modal-title-all-quiz">Quiz Selesai!</h2>
        <p class="modal-subtitle-all-quiz">Anda berhasil menyelesaikan quiz Sejarah Budaya</p>

        <div class="score-card-all-quiz">
            <div class="score-percentage-all-quiz">0%</div>
            <div class="score-label-all-quiz">Skor Anda</div>
            <div class="score-detail-all-quiz">
                <div class="check-circle-all-quiz">✓</div>
                <span>0 dari 3 benar</span>
            </div>
        </div>

        <div class="stats-grid-all-quiz">
            <div class="stat-box-all-quiz">
                <div class="stat-number-all-quiz correct">0</div>
                <div class="stat-label-modal-all-quiz">Jawaban Benar</div>
            </div>
            <div class="stat-box-all-quiz">
                <div class="stat-number-all-quiz incorrect">3</div>
                <div class="stat-label-modal-all-quiz">Jawaban Salah</div>
            </div>
            <div class="stat-box-all-quiz">
                <div class="stat-number-all-quiz points">+0</div>
                <div class="stat-label-modal-all-quiz">Poin Diperoleh</div>
            </div>
        </div>

        <div class="modal-buttons-all-quiz">
            <button class="modal-btn-all-quiz btn-back-modal">
                Coba lagi
            </button>
            <button class="modal-btn-all-quiz btn-retry-modal">
                Coba Quiz Lain
            </button>
        </div>
    </div>
</div>

@include('components.footer')

<script>
    const options = document.querySelectorAll('.option-all-quiz');
        let selectedOption = null;

        options.forEach(option => {
            option.addEventListener('click', function() {
                options.forEach(opt => opt.classList.remove('selected'));

                this.classList.add('selected');
                selectedOption = this;

                if (navigator.vibrate) {
                    navigator.vibrate(50);
                }
            });
        });

        const btnNext = document.querySelector('.btn-next-all-quiz');
        const btnPrev = document.querySelector('.btn-prev-all-quiz');

        btnNext.addEventListener('click', function() {
    if (selectedOption) {
        const isLastQuestion = true; 
        
        if (isLastQuestion) {
            showQuizResult(0, 3); 
        } else {
            console.log('Moving to next question');
        }
    } else {
        alert('Silakan pilih jawaban terlebih dahulu!');
    }
});

        btnPrev.addEventListener('click', function() {
            console.log('Moving to previous question');
        });

        const navNumbers = document.querySelectorAll('.nav-number-all-quiz');
        navNumbers.forEach(nav => {
            nav.addEventListener('click', function() {
                navNumbers.forEach(n => n.classList.remove('active'));
                this.classList.add('active');
            });
        });

function showQuizResult(correctAnswers, totalQuestions) {
    const percentage = Math.round((correctAnswers / totalQuestions) * 100);
    const incorrectAnswers = totalQuestions - correctAnswers;
    const points = correctAnswers * 10;

    document.querySelector('.score-percentage-all-quiz').textContent = percentage + '%';
    document.querySelector('.score-detail-all-quiz span').textContent = `${correctAnswers} dari ${totalQuestions} benar`;
    document.querySelectorAll('.stat-number-all-quiz')[0].textContent = correctAnswers;
    document.querySelectorAll('.stat-number-all-quiz')[1].textContent = incorrectAnswers;
    document.querySelectorAll('.stat-number-all-quiz')[2].textContent = '+' + points;

    document.getElementById('quizModal').classList.add('active');
}

document.querySelector('.btn-back-modal').addEventListener('click', function() {
    document.getElementById('quizModal').classList.remove('active');
    window.location.href = '/sejarah-budaya-quiz'; 
});

document.querySelector('.btn-retry-modal').addEventListener('click', function() {
    document.getElementById('quizModal').classList.remove('active');
    window.location.href = '/quiz'; 
});

document.getElementById('quizModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.remove('active');
    }
});

setTimeout(() => showQuizResult(0, 3), 2000);
</script>