@include('components.head')

@include('components.navbar')

<div class="container-detail-bahasa">
    <a class="back-button-detail-bahasa" onclick="window.history.back()">Kembali</a>

    <div class="content-detail-bahasa">
        <div class="content-card-detail-bahasa">
            <h1>Kosakata Dasar</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Kata Ganti</h2>

            <p class="section-text-detail-bahasa">
                Berikut adalah kata ganti dalam bahasa Osing:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Ingsun</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Saya</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Koen</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Kamu</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Budaya Dheweke</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Dia</div>
            </div>

            <h2>Sapaan Umum</h2>

            <p class="section-text-detail-bahasa">
                Sapaan yang sering digunakan sehari-hari:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Piye kabare?</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Apa kabar?</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Matur nuwun</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Terima kasih</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Nggih</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Ya</div>
            </div>

            <a onclick="window.history.back()" class="return-button-detail-bahasa">Kembali ke Daftar
                Pelajaran</a>
        </div>
    </div>
</div>

@include('components.footer')
