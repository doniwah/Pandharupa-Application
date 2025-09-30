<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library Pendalungan</title>
    <link rel="stylesheet" href="{{ asset('css/pages') }}/elibrary.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .container-koleksi {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-koleksi {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .hero-koleksi h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .hero-koleksi p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .search-section-koleksi {
            padding: 30px 20px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-container-koleksi {
            max-width: 1200px;
            margin: 0 auto;
        }

        .filter-tabs-koleksi {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .search-input-koleksi {
            flex: 1;
            min-width: 250px;
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
        }

        .filter-tab-koleksi {
            padding: 10px 20px;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-tab-koleksi:hover {
            background: #f5f5f5;
        }

        .filter-tab-koleksi.active {
            background: #FF7A00;
            color: white;
            border-color: #FF7A00;
        }

        .stats-koleksi {
            padding: 40px 20px;
        }

        .stats-grid-koleksi {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-item-koleksi {
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .stat-number-koleksi {
            font-size: 2.5rem;
            font-weight: bold;
            color: #FF7A00;
            margin-bottom: 10px;
        }

        .stat-label-koleksi {
            color: #666;
            font-size: 1rem;
        }

        .content-section-koleksi {
            padding: 40px 20px;
        }

        .content-grid-koleksi {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .content-card-koleksi {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .content-card-koleksi:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .content-icon-koleksi {
            width: 50px;
            height: 50px;
            background: #fff3e6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .content-type-koleksi {
            display: inline-block;
            background: #FF7A00;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .content-title-koleksi {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 10px;
        }

        .content-description-koleksi {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .content-meta-koleksi {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 15px;
        }

        .content-meta-koleksi div {
            margin-bottom: 5px;
        }

        .content-stats-koleksi {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #666;
        }

        .content-actions-koleksi {
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s;
        }

        .btn-primary-koleksi {
            background: #FF7A00;
            color: white;
        }

        .btn-primary-koleksi:hover {
            background: #e66d00;
        }

        .btn-secondary-koleksi {
            background: #f0f0f0;
            color: #333;
        }

        .btn-secondary-koleksi:hover {
            background: #e0e0e0;
        }

        /* Popup Styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .popup-overlay.active {
            display: flex;
        }

        .popup-content {
            background: white;
            border-radius: 16px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .popup-header {
            padding: 25px;
            border-bottom: 1px solid #e0e0e0;
        }

        .popup-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 30px;
            height: 30px;
            border: none;
            background: #f5f5f5;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .popup-close:hover {
            background: #e0e0e0;
        }

        .popup-icon {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .popup-icon-circle {
            width: 50px;
            height: 50px;
            background: #fff3e6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .popup-title {
            font-size: 1.5rem;
            color: #333;
            margin: 0;
        }

        .popup-subtitle {
            color: #666;
            margin-top: 5px;
        }

        .popup-body {
            padding: 25px;
        }

        .info-box {
            background: #fff8f0;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .info-box h3 {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 15px;
        }

        .info-box p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .info-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 0.95rem;
        }

        .info-details strong {
            color: #333;
        }

        .preview-box {
            margin-bottom: 25px;
        }

        .preview-box h3 {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 15px;
        }

        .preview-content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            font-style: italic;
            color: #666;
            line-height: 1.8;
        }

        .audio-player {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .audio-icon {
            width: 50px;
            height: 50px;
            background: #FF7A00;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .audio-info h4 {
            font-size: 1rem;
            color: #333;
            margin-bottom: 5px;
        }

        .audio-info p {
            font-size: 0.9rem;
            color: #666;
        }

        .play-button {
            margin-left: auto;
            padding: 10px 25px;
            background: #4285f4;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s;
        }

        .play-button:hover {
            background: #3367d6;
        }

        .popup-footer {
            padding: 20px 25px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            gap: 10px;
        }

        .btn-download {
            flex: 1;
            padding: 12px;
            background: #FF7A00;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.3s;
            text-decoration: none;
        }

        .btn-download:hover {
            background: #e66d00;
        }

        .btn-share {
            padding: 12px 20px;
            background: white;
            color: #333;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-share:hover {
            background: #f5f5f5;
        }

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
                @foreach ($koleksi as $item)
                    <div class="content-card-koleksi" data-kategori="{{ $item->kategori }}">
                        {{-- Icon berdasarkan kategori --}}
                        <div class="content-icon-koleksi">
                            @if ($item->kategori == 'Naskah')
                                {{-- Icon buku (naskah) --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00"
                                    viewBox="0 0 24 24">
                                    <path d="M4 19.5A2.5 2.5 0 0 0 6.5 22H20v-2H6.5a.5.5 0 0 1-.5-.5V4H4z" />
                                    <path d="M18 2H8v13h12V4a2 2 0 0 0-2-2z" />
                                </svg>
                            @elseif ($item->kategori == 'Lagu' || $item->kategori == 'Audio')
                                {{-- Icon musik --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00"
                                    viewBox="0 0 24 24">
                                    <path d="M12 3v10.55A4 4 0 1 0 14 17V7h4V3h-6z" />
                                </svg>
                            @elseif ($item->kategori == 'Dokumentasi' || $item->kategori == 'Video')
                                {{-- Icon video --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00"
                                    viewBox="0 0 24 24">
                                    <path d="M17 10.5V6c0-1.1-.9-2-2-2H5C3.9 4 3 4.9 3 6v12c0
                                1.1.9 2 2 2h10c1.1 0 2-.9 2-2v-4.5l4 4v-11l-4 4z" />
                                </svg>
                            @else
                                {{-- Default icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#999"
                                    viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                </svg>
                            @endif
                        </div>

                        <span class="content-type-koleksi">{{ $item->kategori }}</span>
                        <h3 class="content-title-koleksi">{{ $item->judul }}</h3>
                        <p class="content-description-koleksi">{{ $item->deskripsi }}</p>

                        <div class="content-meta-koleksi">
                            <div>Penulis: {{ $item->penulis }}</div>
                            <div>Tahun: {{ $item->tahun }}</div>
                            @if ($item->halaman)
                                <div>Halaman: {{ $item->halaman }}</div>
                            @endif
                            @if ($item->durasi)
                                <div>Durasi: {{ $item->durasi }}</div>
                            @endif
                        </div>

                        <div class="content-stats-koleksi">
                            <span>👁️ {{ $item->jumlah_suka }}</span>
                            <span>💾 {{ $item->jumlah_unduh }}</span>
                        </div>

                        <div class="content-actions-koleksi">
                            <button class="btn btn-primary-koleksi" onclick='showPopup(@json($item))'>
                                👁️ Lihat
                            </button>
                            <a href="{{ route('elibrary.unduh', $item->id) }}" class="btn btn-secondary-koleksi">
                                💾 Unduh
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popup Modal -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content">
            <div class="popup-header">
                <button class="popup-close" id="closePopup">×</button>
                <div class="popup-icon">
                    <div class="popup-icon-circle" id="popupIconCircle">
                        <span id="popupIcon"></span>
                    </div>
                    <div>
                        <h2 class="popup-title" id="popupTitle"></h2>
                        <p class="popup-subtitle" id="popupSubtitle"></p>
                    </div>
                </div>
            </div>
            <div class="popup-body" id="popupBody">
                <!-- Content will be dynamically inserted -->
            </div>
            <div class="popup-footer">
                <a href="#" class="btn-download" id="downloadBtn">
                    <span>💾</span> Unduh
                </a>
                <button class="btn-share">Bagikan</button>
            </div>
        </div>
    </div>

    <script>
        // Get icon SVG based on category
        function getIconSVG(kategori) {
            const icons = {
                'Naskah': '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 0 6.5 22H20v-2H6.5a.5.5 0 0 1-.5-.5V4H4z"/><path d="M18 2H8v13h12V4a2 2 0 0 0-2-2z"/></svg>',
                'Lagu': '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00" viewBox="0 0 24 24"><path d="M12 3v10.55A4 4 0 1 0 14 17V7h4V3h-6z"/></svg>',
                'Audio': '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00" viewBox="0 0 24 24"><path d="M12 3v10.55A4 4 0 1 0 14 17V7h4V3h-6z"/></svg>',
                'Dokumentasi': '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00" viewBox="0 0 24 24"><path d="M17 10.5V6c0-1.1-.9-2-2-2H5C3.9 4 3 4.9 3 6v12c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2v-4.5l4 4v-11l-4 4z"/></svg>',
                'Video': '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00" viewBox="0 0 24 24"><path d="M17 10.5V6c0-1.1-.9-2-2-2H5C3.9 4 3 4.9 3 6v12c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2v-4.5l4 4v-11l-4 4z"/></svg>'
            };
            return icons[kategori] ||
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#999" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>';
        }

        // Show popup with item data
        function showPopup(item) {
            const popup = document.getElementById('popupOverlay');
            const title = document.getElementById('popupTitle');
            const subtitle = document.getElementById('popupSubtitle');
            const icon = document.getElementById('popupIcon');
            const body = document.getElementById('popupBody');
            const downloadBtn = document.getElementById('downloadBtn');

            // Set popup header
            title.textContent = item.judul;
            subtitle.textContent = item.deskripsi;
            icon.innerHTML = getIconSVG(item.kategori);

            // Set download button URL
            downloadBtn.href = `elibrary/unduh/${item.id}`;

            let bodyContent = '';

            // Naskah popup
            if (item.kategori === 'Naskah') {
                bodyContent = `
                    <div class="info-box">
                        <h3>Informasi Naskah</h3>
                        <p>${item.deskripsi}</p>
                        <div class="info-details">
                            <div><strong>Tahun:</strong> ${item.tahun} | <strong>Sumber:</strong> Koleksi Digital Pendalungan</div>
                        </div>
                    </div>
                    ${item.preview ? `
                                        <div class="preview-box">
                                            <h3>Preview Naskah</h3>
                                            <div class="preview-content">
                                                "${item.preview}"
                                            </div>
                                        </div>
                                        ` : ''}
                `;
            }
            // Audio/Lagu popup
            else if (item.kategori === 'Lagu' || item.kategori === 'Audio') {
                bodyContent = `
                    <div class="info-box">
                        <h3>Informasi Audio</h3>
                        <div class="info-details">
    ${item.durasi ? `<div><strong>Durasi:</strong> ${item.durasi}</div>` : ''}
    ${item.format ? `<div><strong>Format:</strong> ${item.format}</div>` : ''}
    ${item.kualitas ? `<div><strong>Kualitas:</strong> ${item.kualitas}</div>` : ''}
    ${item.ukuran ? `<div><strong>Ukuran:</strong> ${item.ukuran}</div>` : ''}
                        </div>
                    </div>
                    <div class="preview-box">
                        <h3>Preview Audio</h3>
                        <div class="audio-player">
                            <div class="audio-icon">🎵</div>
                            <div class="audio-info">
                                <h4>${item.judul}</h4>
                                <p>Audio tradisional Pendalungan</p>
                            </div>
                            <button class="play-button">▶ Play</button>
                        </div>
                    </div>
                `;
            }
            // Video/Dokumentasi popup
            else if (item.kategori === 'Video' || item.kategori === 'Dokumentasi') {
                bodyContent = `
                    <div class="info-box">
                        <h3>Informasi Video</h3>
                        <p>${item.deskripsi}</p>
                        <div class="info-details">
                            <div><strong>Tahun:</strong> ${item.tahun} | <strong>Sumber:</strong> Koleksi Digital Pendalungan</div>
                            ${item.durasi ? `<div><strong>Durasi:</strong> ${item.durasi}</div>` : ''}
                        </div>
                    </div>
                `;
            }

            body.innerHTML = bodyContent;
            popup.classList.add('active');
        }

        // Close popup
        document.getElementById('closePopup').addEventListener('click', () => {
            document.getElementById('popupOverlay').classList.remove('active');
        });

        document.getElementById('popupOverlay').addEventListener('click', (e) => {
            if (e.target.id === 'popupOverlay') {
                document.getElementById('popupOverlay').classList.remove('active');
            }
        });

        // Filter functionality
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
                    const contentType = card.querySelector('.content-type-koleksi').textContent
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
</body>

</html>
