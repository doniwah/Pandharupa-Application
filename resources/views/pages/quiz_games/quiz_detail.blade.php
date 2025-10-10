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
                    <h1>{{ $quiz->title }}</h1>
                    <span class="difficulty-badge-all-quiz badge-{{ $quiz->difficulty }}">
                        {{ ucfirst($quiz->difficulty) }}
                    </span>
                </div>
                <div class="progress-info-all-quiz">
                    <div class="progress-label-all-quiz">Progress</div>
                    <div class="progress-percentage-all-quiz" id="progressPercentage">0%</div>
                </div>
            </div>
            <div class="quiz-meta-all-quiz">
                <span id="questionInfo">Pertanyaan <span id="currentQuestion">1</span> dari {{ $quiz->questions->count()
                    }}</span>
                <span>⏱ <span id="timer">{{ $quiz->time_limit }}:00</span></span>
            </div>
            <div class="progress-bar-all-quiz">
                <div class="progress-fill-all-quiz" id="progressFill" style="width: 0%"></div>
            </div>
        </div>

        <div class="question-card-all-quiz">
            <div class="question-body-all-quiz">
                <div class="question-number-all-quiz" id="questionNumber">1</div>
                <div class="question-text-all-quiz" id="questionText">
                    {{ $quiz->questions->first()->question_text }}
                </div>
            </div>

            <div class="options-all-quiz" id="optionsContainer">
                @foreach(['a', 'b', 'c', 'd'] as $option)
                @php
                $optionKey = 'option_' . $option;
                @endphp
                @if($quiz->questions->first()->$optionKey)
                <div class="option-all-quiz" data-option="{{ $option }}">
                    <div class="option-radio-all-quiz"></div>
                    <div class="option-text-all-quiz">{{ $quiz->questions->first()->$optionKey }}</div>
                    <div class="check-icon-all-quiz">✓</div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="navigation-buttons-all-quiz">
                <button class="nav-btn-all-quiz btn-prev-all-quiz" id="btnPrev" disabled>
                    ← Sebelumnya
                </button>
                <button class="nav-btn-all-quiz btn-next-all-quiz" id="btnNext">
                    Selanjutnya →
                </button>
            </div>
        </div>

        <div class="question-nav-all-quiz">
            <div class="nav-title-all-quiz">Navigasi Soal</div>
            <div class="nav-numbers-all-quiz" id="navNumbers">
                @foreach($quiz->questions as $index => $question)
                <button class="nav-number-all-quiz {{ $index === 0 ? 'active' : '' }}" data-question="{{ $index + 1 }}">
                    {{ $index + 1 }}
                </button>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay-all-quiz" id="quizModal">
    <div class="modal-content-all-quiz">
        <div class="trophy-icon-all-quiz"><i class="bi bi-trophy"></i></div>
        <h2 class="modal-title-all-quiz">Quiz Selesai!</h2>
        <p class="modal-subtitle-all-quiz">Anda berhasil menyelesaikan quiz {{ $quiz->title }}</p>

        <div class="score-card-all-quiz">
            <div class="score-percentage-all-quiz" id="finalPercentage">0%</div>
            <div class="score-label-all-quiz">Skor Anda</div>
            <div class="score-detail-all-quiz">
                <div class="check-circle-all-quiz">✓</div>
                <span id="finalScore">0 dari {{ $quiz->questions->count() }} benar</span>
            </div>
        </div>

        <div class="stats-grid-all-quiz">
            <div class="stat-box-all-quiz">
                <div class="stat-number-all-quiz correct" id="correctCount">0</div>
                <div class="stat-label-modal-all-quiz">Jawaban Benar</div>
            </div>
            <div class="stat-box-all-quiz">
                <div class="stat-number-all-quiz incorrect" id="incorrectCount">{{ $quiz->questions->count() }}</div>
                <div class="stat-label-modal-all-quiz">Jawaban Salah</div>
            </div>
            <div class="stat-box-all-quiz">
                <div class="stat-number-all-quiz points" id="pointsEarned">+0</div>
                <div class="stat-label-modal-all-quiz">Poin Diperoleh</div>
            </div>
        </div>

        <div class="modal-buttons-all-quiz">
            <button class="modal-btn-all-quiz btn-back-modal" onclick="location.reload()">
                Coba lagi
            </button>
            <button class="modal-btn-all-quiz btn-retry-modal" onclick="window.location.href='/quiz'">
                Coba Quiz Lain
            </button>
        </div>
    </div>
</div>

@include('components.footer')

<script>
    // Quiz data from backend
const quizData = {
    id: {{ $quiz->id }},
    title: '{{ addslashes($quiz->title) }}',
    timeLimit: {{ $quiz->time_limit }},
    questions: {!! json_encode($quiz->questions->map(function($q) {
        return [
            'id' => $q->id,
            'question_text' => $q->question_text,
            'option_a' => $q->option_a,
            'option_b' => $q->option_b,
            'option_c' => $q->option_c,
            'option_d' => $q->option_d,
            'correct_answer' => $q->correct_answer,
            'explanation' => $q->explanation
        ];
    })) !!}
};

// Quiz state
let currentQuestionIndex = 0;
let userAnswers = {};
let timeRemaining = quizData.timeLimit * 60;
let timerInterval;
let quizStartTime = Date.now();

// Initialize quiz
document.addEventListener('DOMContentLoaded', function() {
    console.log('Quiz initialized');
    initializeQuiz();
    startTimer();
    setupEventListeners();
});

function initializeQuiz() {
    displayQuestion(0);
    updateProgress();
}

function setupEventListeners() {
    document.addEventListener('click', function(e) {
        const option = e.target.closest('.option-all-quiz');
        if (option) {
            selectOption(option);
        }
    });

    document.getElementById('btnNext').addEventListener('click', handleNext);
    document.getElementById('btnPrev').addEventListener('click', handlePrev);

    document.querySelectorAll('.nav-number-all-quiz').forEach(btn => {
        btn.addEventListener('click', function() {
            const questionNum = parseInt(this.dataset.question) - 1;
            goToQuestion(questionNum);
        });
    });
}

function displayQuestion(index) {
    const question = quizData.questions[index];

    document.getElementById('questionNumber').textContent = index + 1;
    document.getElementById('questionText').textContent = question.question_text;
    document.getElementById('currentQuestion').textContent = index + 1;

    const optionsContainer = document.getElementById('optionsContainer');
    optionsContainer.innerHTML = '';

    ['a', 'b', 'c', 'd'].forEach(opt => {
        const optionText = question['option_' + opt];
        if (optionText) {
            const optionDiv = document.createElement('div');
            optionDiv.className = 'option-all-quiz';
            optionDiv.dataset.option = opt;

            if (userAnswers[question.id] === opt) {
                optionDiv.classList.add('selected');
            }

            optionDiv.innerHTML = `
                <div class="option-radio-all-quiz"></div>
                <div class="option-text-all-quiz">${optionText}</div>
                <div class="check-icon-all-quiz">✓</div>
            `;

            optionsContainer.appendChild(optionDiv);
        }
    });

    document.getElementById('btnPrev').disabled = index === 0;
    document.getElementById('btnNext').textContent =
        index === quizData.questions.length - 1 ? 'Selesai' : 'Selanjutnya →';

    document.querySelectorAll('.nav-number-all-quiz').forEach((btn, i) => {
        btn.classList.toggle('active', i === index);
        btn.classList.toggle('answered', userAnswers[quizData.questions[i].id] !== undefined);
    });
}

function selectOption(optionElement) {
    const questionId = quizData.questions[currentQuestionIndex].id;
    const selectedOption = optionElement.dataset.option;

    document.querySelectorAll('.option-all-quiz').forEach(opt => {
        opt.classList.remove('selected');
    });

    optionElement.classList.add('selected');
    userAnswers[questionId] = selectedOption;

    const navBtn = document.querySelector(`.nav-number-all-quiz[data-question="${currentQuestionIndex + 1}"]`);
    if (navBtn) navBtn.classList.add('answered');

    if (navigator.vibrate) {
        navigator.vibrate(50);
    }
}

function handleNext() {
    const currentQuestion = quizData.questions[currentQuestionIndex];

    if (!userAnswers[currentQuestion.id]) {
        alert('Silakan pilih jawaban terlebih dahulu!');
        return;
    }

    if (currentQuestionIndex === quizData.questions.length - 1) {
        finishQuiz();
    } else {
        currentQuestionIndex++;
        displayQuestion(currentQuestionIndex);
        updateProgress();
    }
}

function handlePrev() {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        displayQuestion(currentQuestionIndex);
        updateProgress();
    }
}

function goToQuestion(index) {
    currentQuestionIndex = index;
    displayQuestion(index);
    updateProgress();
}

function updateProgress() {
    const progress = ((currentQuestionIndex + 1) / quizData.questions.length) * 100;
    document.getElementById('progressFill').style.width = progress + '%';
    document.getElementById('progressPercentage').textContent = Math.round(progress) + '%';
}

function startTimer() {
    timerInterval = setInterval(function() {
        timeRemaining--;

        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        document.getElementById('timer').textContent =
            `${minutes}:${seconds.toString().padStart(2, '0')}`;

        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            finishQuiz();
        }
    }, 1000);
}

function finishQuiz() {
    clearInterval(timerInterval);

    // Calculate results
    let correctAnswers = 0;
    quizData.questions.forEach(question => {
        if (userAnswers[question.id] === question.correct_answer) {
            correctAnswers++;
        }
    });

    const totalQuestions = quizData.questions.length;
    const percentage = Math.round((correctAnswers / totalQuestions) * 100);
    const points = correctAnswers * 10;

    // PERBAIKAN: Hitung waktu yang benar (dalam detik)
    const timeTaken = (quizData.timeLimit * 60) - timeRemaining;

    console.log('FINISH QUIZ DATA:', {
        timeTaken: timeTaken,
        correctAnswers: correctAnswers,
        points: points,
        percentage: percentage
    });

    // Update modal UI
    document.getElementById('finalPercentage').textContent = percentage + '%';
    document.getElementById('finalScore').textContent = `${correctAnswers} dari ${totalQuestions} benar`;
    document.getElementById('correctCount').textContent = correctAnswers;
    document.getElementById('incorrectCount').textContent = totalQuestions - correctAnswers;
    document.getElementById('pointsEarned').textContent = '+' + points;

    // Show modal
    document.getElementById('quizModal').classList.add('active');

    // PERBAIKAN: Submit dengan data yang benar
    submitQuizResults({
        time_taken: timeTaken,  // PASTIKAN INI time_taken BUKAN time_token
        correct_answers: correctAnswers,
        score: points,
        percentage: percentage,
        answers: userAnswers
    }).then(result => {
        if (result && result.success) {
            console.log('Quiz submitted successfully:', result);
        } else {
            console.error('Quiz submission failed:', result);
        }
    }).catch(error => {
        console.error('Error submitting quiz:', error);
    });
}

function submitQuizResults(results) {
    console.log('=== SUBMITTING QUIZ ===');
    console.log('Data to submit:', results);

    // PERBAIKAN: Payload yang konsisten
    const payload = {
        time_taken: parseInt(results.time_taken) || 0,
        correct_answers: parseInt(results.correct_answers) || 0,
        score: parseInt(results.score) || 0,
        percentage: parseFloat(results.percentage) || 0,
        answers: results.answers || {}
    };

    console.log('Final payload:', payload);

    return fetch(`/quiz/${quizData.id}/submit`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);

        if (!response.ok) {
            return response.text().then(text => {
                console.error('Server error response:', text);
                throw new Error(`Server error: ${response.status} - ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('=== SERVER RESPONSE ===');
        console.log('Success:', data.success);
        console.log('Message:', data.message);
        console.log('Data:', data.data);
        return data;
    })
    .catch(error => {
        console.error('=== SUBMIT ERROR ===');
        console.error('Error:', error);
        console.error('Stack:', error.stack);
        return {
            success: false,
            error: error.message
        };
    });
}

</script>
