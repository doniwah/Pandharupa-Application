@include('components.head')

@include('components.navbar')

<div class="container-detail-bahasa">
    <a class="back-button-detail-bahasa" onclick="window.history.back()">Kembali</a>

    <div class="content-detail-bahasa">
        <div class="content-card-detail-bahasa">
            <h1>Tingkat Tutur Ngoko</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Pengertian Ngoko</h2>

            <p class="section-text-detail-bahasa">
                Tingkat tutur Ngoko adalah tingkat bahasa Jawa yang paling santai dan informal. Digunakan dalam
                percakapan sehari-hari dengan teman sebaya atau orang yang lebih muda.
            </p>

            <h2>Ciri-ciri Bahasa Ngoko</h2>

            <p class="section-text-detail-bahasa">
                Bahasa Ngoko memiliki karakteristik tersendiri:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Informal</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Digunakan dalam situasi santai</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Sederhana</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Struktur kalimat yang lebih sederhana</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Akrab</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Menciptakan suasana keakraban</div>
            </div>

            <a onclick="window.history.back()" class="return-button-detail-bahasa">Kembali ke Daftar
                Pelajaran</a>
        </div>
    </div>
</div>

@include('components.footer')
