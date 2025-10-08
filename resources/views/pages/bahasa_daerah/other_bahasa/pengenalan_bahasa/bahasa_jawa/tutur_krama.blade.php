@include('components.head')

@include('components.navbar')

<div class="container-detail-bahasa">
    <a class="back-button-detail-bahasa" onclick="window.history.back()">Kembali</a>

    <div class="content-detail-bahasa">
        <div class="content-card-detail-bahasa">
            <h1>Tingkat Tutur Krama</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Pengertian Krama</h2>

            <p class="section-text-detail-bahasa">
                Tingkat tutur Krama adalah tingkat bahasa Jawa yang lebih halus dan sopan. Digunakan untuk berbicara
                dengan orang yang lebih tua atau dalam situasi formal.
            </p>

            <h2>Jenis-jenis Krama</h2>

            <p class="section-text-detail-bahasa">
                Terdapat beberapa jenis tingkat tutur Krama:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Krama Inggil</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Tingkat paling tinggi dan sangat hormat</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Krama Madya
                </div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">
                    Tingkat menengah antara Ngoko dan Krama</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Krama Andhap</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">
                    Tingkat Krama dasar</div>
            </div>

            <a onclick="window.history.back()" class="return-button-detail-bahasa">Kembali ke Daftar
                Pelajaran</a>
        </div>
    </div>
</div>

@include('components.footer')
