<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library Pendalungan</title>
    <link rel="stylesheet" href="{{ asset('css/pages') }}/elibrary.css">
</head>

<body>
    <section class="hero-koleksi">
        <div class="container-koleksi">
            <h1>E-Library Pendalungan</h1>
            <p>Perpustakaan digital lengkap untuk menjelajahi naskah, lagu, dan dokumentasi budaya Pendalungan</p>
        </div>
    </section>

    <section class="search-section-koleksi">
        <div class="container-koleksi">
            <div class="search-container-koleksi">
                <div class="filter-tabs-koleksi">
                    <input type="text" class="search-input-koleksi"
                        placeholder="Cari naskah, lagu, atau dokumentasi...">
                    <button class="filter-tab-koleksi active">Semua</button>
                    <button class="filter-tab-koleksi">Naskah</button>
                    <button class="filter-tab-koleksi">Lagu</button>
                    <button class="filter-tab-koleksi">Dokumentasi</button>
                    <button class="filter-tab-koleksi">Video</button>
                    <button class="filter-tab-koleksi">Audio</button>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-koleksi">
        <div class="container-koleksi">
            <div class="stats-grid-koleksi">
                <div class="stat-item-koleksi">
                    <div class="stat-number-koleksi">245</div>
                    <div class="stat-label-koleksi">Total Koleksi</div>
                </div>
                <div class="stat-item-koleksi">
                    <div class="stat-number-koleksi">89</div>
                    <div class="stat-label-koleksi">Naskah</div>
                </div>
                <div class="stat-item-koleksi">
                    <div class="stat-number-koleksi">67</div>
                    <div class="stat-label-koleksi">Audio & Lagu</div>
                </div>
                <div class="stat-item-koleksi">
                    <div class="stat-number-koleksi">89</div>
                    <div class="stat-label-koleksi">Video & Dokumenter</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Grid -->
    <section class="content-section-koleksi">
        <div class="container-koleksi">
            <div class="content-grid-koleksi">
                <!-- Content Item 1 -->
                <div class="content-card-koleksi">
                    <span class="content-type-koleksi">Naskah</span>
                    <span class="content-icon-koleksi">📖</span>
                    <h3 class="content-title-koleksi">Legenda Asal Mula Pendalungan</h3>
                    <p class="content-description-koleksi">Koleksi cerita rakyat tentang asal-usul daerah Pendalungan
                    </p>
                    <div class="content-meta-koleksi">
                        <div>Penulis: Tim Peneliti Budaya</div>
                        <div>Tahun: 2023</div>
                        <div>Halaman: 45</div>
                    </div>
                    <div class="content-stats-koleksi">
                        <span>👁️ 1230</span>
                        <span>💾 5680</span>
                    </div>
                    <div class="content-actions-koleksi">
                        <button class="btn btn-primary-koleksi">👁️ Lihat</button>
                        <button class="btn btn-secondary-koleksi">💾 Unduh</button>
                    </div>
                </div>

                <!-- Content Item 2 -->
                <div class="content-card-koleksi">
                    <span class="content-type-koleksi">Lagu</span>
                    <span class="content-icon-koleksi">🎵</span>
                    <h3 class="content-title-koleksi">Lagu Tradisional 'Tanduk Majeng'</h3>
                    <p class="content-description-koleksi">Rekaman dan lirik lagu tradisional Pendalungan</p>
                    <div class="content-meta-koleksi">
                        <div>Penulis: Sanggar Seni Budaya</div>
                        <div>Tahun: 2022</div>
                        <div>Durasi: 4:32</div>
                    </div>
                    <div class="content-stats-koleksi">
                        <span>👁️ 890</span>
                        <span>💾 3420</span>
                    </div>
                    <div class="content-actions-koleksi">
                        <button class="btn btn-primary-koleksi">👁️ Lihat</button>
                        <button class="btn btn-secondary-koleksi">💾 Unduh</button>
                    </div>
                </div>

                <!-- Content Item 3 -->
                <div class="content-card-koleksi">
                    <span class="content-type-koleksi">Dokumentasi</span>
                    <span class="content-icon-koleksi">📚</span>
                    <h3 class="content-title-koleksi">Dokumenter Tari Jejer</h3>
                    <p class="content-description-koleksi">Film dokumenter tentang tarian tradisional Jejer</p>
                    <div class="content-meta-koleksi">
                        <div>Penulis: Studio Dokumenter Nusantara</div>
                        <div>Tahun: 2024</div>
                        <div>Durasi: 28:15</div>
                    </div>
                    <div class="content-stats-koleksi">
                        <span>👁️ 456</span>
                        <span>💾 2100</span>
                    </div>
                    <div class="content-actions-koleksi">
                        <button class="btn btn-primary-koleksi">👁️ Lihat</button>
                        <button class="btn btn-secondary-koleksi">💾 Unduh</button>
                    </div>
                </div>

                <!-- Content Item 4 -->
                <div class="content-card-koleksi">
                    <span class="content-type-koleksi">Naskah</span>
                    <span class="content-icon-koleksi">📖</span>
                    <h3 class="content-title-koleksi">Kumpulan Pantun Pendalungan</h3>
                    <p class="content-description-koleksi">Koleksi pantun dan syair tradisional daerah</p>
                    <div class="content-meta-koleksi">
                        <div>Penulis: Komunitas Sastra Lokal</div>
                        <div>Tahun: 2023</div>
                        <div>Halaman: 78</div>
                    </div>
                    <div class="content-stats-koleksi">
                        <span>👁️ 670</span>
                        <span>💾 2890</span>
                    </div>
                    <div class="content-actions-koleksi">
                        <button class="btn btn-primary-koleksi">👁️ Lihat</button>
                        <button class="btn btn-secondary-koleksi">💾 Unduh</button>
                    </div>
                </div>

                <!-- Content Item 5 -->
                <div class="content-card-koleksi">
                    <span class="content-type-koleksi">Video</span>
                    <span class="content-icon-koleksi">🎬</span>
                    <h3 class="content-title-koleksi">Tutorial Membatik Motif Pendalungan</h3>
                    <p class="content-description-koleksi">Panduan lengkap membuat batik dengan motif khas Pendalungan
                    </p>
                    <div class="content-meta-koleksi">
                        <div>Penulis: Perajin Batik Tradisional</div>
                        <div>Tahun: 2024</div>
                        <div>Durasi: 45:22</div>
                    </div>
                    <div class="content-stats-koleksi">
                        <span>👁️ 320</span>
                        <span>💾 1560</span>
                    </div>
                    <div class="content-actions-koleksi">
                        <button class="btn btn-primary-koleksi">👁️ Lihat</button>
                        <button class="btn btn-secondary-koleksi">💾 Unduh</button>
                    </div>
                </div>

                <!-- Content Item 6 -->
                <div class="content-card-koleksi">
                    <span class="content-type-koleksi">Naskah</span>
                    <span class="content-icon-koleksi">📖</span>
                    <h3 class="content-title-koleksi">Sejarah Kerajaan Pendalungan</h3>
                    <p class="content-description-koleksi">Penelitian mendalam tentang sejarah kerajaan dan budaya</p>
                    <div class="content-meta-koleksi">
                        <div>Penulis: Prof. Dr. Budiono Sastro</div>
                        <div>Tahun: 2023</div>
                        <div>Halaman: 156</div>
                    </div>
                    <div class="content-stats-koleksi">
                        <span>👁️ 1100</span>
                        <span>💾 4200</span>
                    </div>
                    <div class="content-actions-koleksi">
                        <button class="btn btn-primary-koleksi">👁️ Lihat</button>
                        <button class="btn btn-secondary-koleksi">💾 Unduh</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const filterTabs = document.querySelectorAll('.filter-tab-koleksi');
        const contentCards = document.querySelectorAll('.content-card-koleksi');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                tab.classList.add('active');

                const filter = tab.textContent.toLowerCase();

                contentCards.forEach(card => {
                    const contentType = card.querySelector('.content-type').textContent
                        .toLowerCase();

                    if (filter === 'semua' || contentType === filter) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.5s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input-koleksi');
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();

            contentCards.forEach(card => {
                const title = card.querySelector('.content-title-koleksi').textContent.toLowerCase();
                const description = card.querySelector('.content-description-koleksi').textContent
                    .toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>

</html>
