@include('components.head')

@include('components.navbar')

<div class="container-detail-bahasa">
    <a class="back-button-detail-bahasa" onclick="window.history.back()">Kembali</a>

    <div class="content-detail-bahasa">
        <div class="content-card-detail-bahasa">
            <h1>Pengenalan Bahasa Osing</h1>

            <div class="divider-detail-bahasa"></div>

            <h2>Sejarah Bahasa Osing</h2>

            <p class="section-text-detail-bahasa">
                Bahasa Osing adalah bahasa yang digunakan oleh suku Osing di Banyuwangi, Jawa Timur. Bahasa ini memiliki
                keunikan tersendiri dalam pelafalan dan kosakata yang berbeda dari bahasa Jawa pada umumnya.
            </p>

            <h2>Ciri Khas Bahasa Osing</h2>

            <p class="section-text-detail-bahasa">
                Bahasa Osing memiliki beberapa ciri khas:
            </p>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Pelafalan Khas</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Memiliki intonasi dan aksen yang berbeda</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Kosakata Unik</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Banyak kosakata yang tidak ditemukan di bahasa Jawa lainnya</div>
            </div>

            <div class="info-box-detail-bahasa">
                <div class="info-label-detail-bahasa">Budaya Lokal</div>
                <div class="vertical-divider-detail-bahasa"></div>
                <div class="info-value-detail-bahasa">Mencerminkan kearifan lokal masyarakat Osing</div>
            </div>

            <a onclick="window.history.back()" class="return-button-detail-bahasa">Kembali ke Daftar
                Pelajaran</a>
        </div>
    </div>
</div>

@include('components.footer')
