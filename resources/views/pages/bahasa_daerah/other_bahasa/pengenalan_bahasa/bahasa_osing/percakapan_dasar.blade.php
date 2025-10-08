@include('components.head')

@include('components.navbar')

<div class="container-detail-bahasa">
    <a class="back-button-detail-bahasa" onclick="window.history.back()">Kembali</a>

    <div class="content-detail-bahasa">
        <div class="content-card-detail-bahasa">
            <h1>Percakapan Dasar</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Dialog Sederhana</h2>

            <p class="section-text-detail-bahasa">
                Contoh percakapan dasar dalam bahasa Osing:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">A: Piye kabare?</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">
                    A: Apa kabar?</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">B: Apik-apik</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">B: Baik-baik</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">A: Arep nyang endi?</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">A: Mau kemana?</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">B: Arep nyang pasar</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">B: Mau ke pasar</div>
            </div>

            <a onclick="window.history.back()" class="return-button-detail-bahasa">Kembali ke Daftar
                Pelajaran</a>
        </div>
    </div>
</div>

@include('components.footer')
