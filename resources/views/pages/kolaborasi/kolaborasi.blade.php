@include('components.head')

@include('components.navbar')

<div class="container-kolaborasi">
    <!-- Hero Section -->
    <div class="hero-section-kolaborasi">
        <h1 class="hero-title-kolaborasi">Kolaborasi Digital Pendalungan</h1>
        <p class="hero-description-kolaborasi">Platform untuk komunitas upload, berbagi, dan berkolaborasi dalam
            karya seni digital. Tari, musik, puisi, dokumenter - semua bentuk ekspresi budaya Pendalungan.</p>
    </div>

    <!-- Stats Section -->
    <div class="stats-grid-kolaborasi">
        <div class="stat-item-kolaborasi">
            <div class="stat-icon-kolaborasi"><i class="bi bi-share-fill"></i></div>
            <div class="stat-number-kolaborasi">456</div>
            <div class="stat-label-kolaborasi">Total Karya</div>
        </div>
        <div class="stat-item-kolaborasi">
            <div class="stat-icon-kolaborasi"><i class="bi bi-people-fill"></i></div>
            <div class="stat-number-kolaborasi">89</div>
            <div class="stat-label-kolaborasi">Kolaborator Aktif</div>
        </div>
        <div class="stat-item-kolaborasi">
            <div class="stat-icon-kolaborasi"><i class="bi bi-download"></i></div>
            <div class="stat-number-kolaborasi">2,340</div>
            <div class="stat-label-kolaborasi">Download Bulan Ini</div>
        </div>
        <div class="stat-item-kolaborasi">
            <div class="stat-icon-kolaborasi"><i class="bi bi-heart-fill"></i></div>
            <div class="stat-number-kolaborasi">1,234</div>
            <div class="stat-label-kolaborasi">Karya Difavoritkan</div>
        </div>
    </div>

    <!-- Filter and Upload Section -->
    <div class="filter-upload-section">
        <div class="filter-tabs">
            <i class="bi bi-funnel"></i>
            <div class="filter-tab active">Semua</div>
            <div class="filter-tab">Tari</div>
            <div class="filter-tab">Musik</div>
            <div class="filter-tab">Puisi</div>
            <div class="filter-tab">Dokumenter</div>
            <div class="filter-tab">Fotografi</div>
            <div class="filter-tab">Kerajinan</div>
        </div>
        <button class="upload-btn">
            <p><strong>+</strong></p>
            <p>Upload Karya</p>
        </button>
    </div>

    <!-- Featured Works -->
    <div class="featured-section-kolaborasi">
        <h2 class="section-title-kolaborasi">Karya Unggulan</h2>
        <div class="content-grid-kolaborasi">
            <div class="content-card-kolaborasi">
                <div class="card-content-kolaborasi">
                    <div class="card-icon-kolaborasi"><svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                            viewBox="0 0 72 72">
                            <g id="color">
                                <path fill="#EA5A47" d="M36 20l-4 8-4 10-5 12h26l-5-12-4-10-4-8z" />
                                <circle cx="36" cy="12" r="4" fill="#F4AA41" />
                            </g>
                            <g id="line" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <circle cx="36" cy="12" r="4" />
                                <path d="M36 20l-4 8-4 10-5 12h26l-5-12-4-10-4-8z" />
                            </g>
                        </svg></div>
                    <div class="card-badge badge-video-kolaborasi">Video</div>
                    <h3 class="card-title-kolaborasi">Kolaborasi Tari Jejer Modern</h3>
                    <p class="card-description-kolaborasi">Interpretasi modern dari tarian tradisional Jejer dengan
                        sentuhan kontemporer.</p>
                    <div class="card-collaborators-kolaborasi">
                        <span>👤 Sari D. 👤 Budi K. 👤 Rina M.</span>
                    </div>
                    <div class="card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span>👁️ 1250</span>
                            <span>👍 89</span>
                            <span>💬 45</span>
                        </div>
                        <span>3 hari lalu</span>
                    </div>
                    <div class="card-actions-kolaborasi">
                        <button class="btn btn-primary-kolaborasi">👁️ Lihat</button>
                        <button class="btn btn-secondary-kolaborasi">⬇️ Unduh</button>
                    </div>
                </div>
            </div>

            <div class="content-card-kolaborasi">
                <div class="card-content-kolaborasi">
                    <div class="card-icon-kolaborasi">📄</div>
                    <div class="card-badge badge-outstanding-kolaborasi">Outstanding</div>
                    <h3 class="card-title-kolaborasi">Dokumenter: Perajin Batik Pendalungan</h3>
                    <p class="card-description-kolaborasi">Film dokumenter tentang kehidupan dan karya para perajin
                        batik tradisional.</p>
                    <div class="card-collaborators-kolaborasi">
                        <span>👤 Ahmad S. 👤 Lisa P. 👤 Doni W.</span>
                    </div>
                    <div class="card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span>👁️ 2100</span>
                            <span>👍 156</span>
                            <span>💬 78</span>
                        </div>
                        <span>1 minggu lalu</span>
                    </div>
                    <div class="card-actions-kolaborasi">
                        <button class="btn btn-primary-kolaborasi">👁️ Lihat</button>
                        <button class="btn btn-secondary-kolaborasi">⬇️ Unduh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- All Works -->
    <div class="all-works-section-kolaborasi">
        <h2 class="section-title-kolaborasi">Semua Karya</h2>
        <div class="all-works-grid-kolaborasi">
            <div class="small-card-kolaborasi">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi">📝</div>
                    <div class="small-card-badge badge-puisi-kolaborasi">Puisi</div>
                    <h3 class="small-card-title-kolaborasi">Kumpulan Puisi: Rindu Kampung</h3>
                    <p class="small-card-description-kolaborasi">Kumpulan puisi yang menggambarkan kerinduan
                        terhadap kampung halaman dan budaya lokal.</p>
                    <div class="small-card-meta-kolaborasi">oleh Maya Ek - 1</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span>👁️ 67</span>
                            <span>👍 12</span>
                            <span>💬 4</span>
                        </div>
                        <span>2 minggu lalu</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi">Lihat</button>
                        <button class="small-btn small-btn-secondary-kolaborasi">⬇️ Unduh</button>
                    </div>
                </div>
            </div>

            <div class="small-card-kolaborasi">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi">🎵</div>
                    <div class="small-card-badge badge-musik-kolaborasi">Musik</div>
                    <h3 class="small-card-title-kolaborasi">Musik Fusion: Gamelan Digital</h3>
                    <p class="small-card-description-kolaborasi">Perpaduan gamelan tradisional dengan sentuhan musik
                        digital modern.</p>
                    <div class="small-card-meta-kolaborasi">oleh Iri Np</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span>👁️ 1400</span>
                            <span>👍 98</span>
                            <span>💬 23</span>
                        </div>
                        <span>3 minggu lalu</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi">Lihat</button>
                        <button class="small-btn small-btn-secondary-kolaborasi">⬇️ Unduh</button>
                    </div>
                </div>
            </div>

            <div class="small-card-kolaborasi">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi">📷</div>
                    <div class="small-card-badge badge-foto-kolaborasi">Foto</div>
                    <h3 class="small-card-title-kolaborasi">Fotografi: Potret Kehidupan Nelayan</h3>
                    <p class="small-card-description-kolaborasi">Dokumentasi visual kehidupan sehari-hari para
                        nelayan yang melestarikan nelayan Pendalungan.</p>
                    <div class="small-card-meta-kolaborasi">oleh Ri Si</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span>👁️ 780</span>
                            <span>👍 54</span>
                            <span>💬 12</span>
                        </div>
                        <span>1 bulan lalu</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi">Lihat</button>
                        <button class="small-btn small-btn-secondary-kolaborasi">⬇️ Unduh</button>
                    </div>
                </div>
            </div>

            <div class="small-card-kolaborasi">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi">🧶</div>
                    <div class="small-card-badge badge-kerajinan-kolaborasi">Kerajinan</div>
                    <h3 class="small-card-title-kolaborasi">Kerajinan: Vas Bambu Kontemporer</h3>
                    <p class="small-card-description-kolaborasi">Desain vas dari bambu dengan sentuhan modern untuk
                        dekorasi rumah.</p>
                    <div class="small-card-meta-kolaborasi">oleh Ana - 1</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span>👁️ 420</span>
                            <span>👍 34</span>
                        </div>
                        <span>1 bulan lalu</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi">Lihat</button>
                        <button class="small-btn small-btn-secondary-kolaborasi">⬇️ Unduh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collaboration CTA -->
    <div class="collaboration-cta-kolaborasi">
        <div class="cta-icon-kolaborasi">🔗</div>
        <h2 class="cta-title-kolaborasi">Siap Berkolaborasi?</h2>
        <p class="cta-description-kolaborasi">Bergabunglah dengan komunitas kreatif dan ciptakan karya seni digital
            yang menginspirasi!</p>
        <div class="cta-buttons-kolaborasi">
            <a href="#" class="cta-btn cta-btn-primary-kolaborasi">📤 Upload Karya</a>
            <a href="#" class="cta-btn cta-btn-secondary-kolaborasi">Daftar Sekarang</a>
        </div>
    </div>
</div>

@include('components.footer')

<script>
    // Filter functionality
        const filterTabs = document.querySelectorAll('.filter-tab');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                tab.classList.add('active');
            });
        });

        // Button click effects
        const buttons = document.querySelectorAll('.btn, .small-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                btn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    btn.style.transform = '';
                }, 150);
            });
        });
</script>
