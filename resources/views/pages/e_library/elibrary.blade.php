<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Library Pendalungan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .modal {
            display: none;
        }

        .modal.active {
            display: flex;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-12 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">E-Library Pendalungan</h1>
            <p class="text-gray-600">Perpustakaan digital lengkap untuk menjelajahi naskah, lagu, dan dokumentasi budaya
                Pendalungan</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6">
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="searchInput" placeholder="Cari naskah, lagu, atau dokumentasi..."
                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="flex flex-wrap gap-3 mb-8">
            <button class="filter-btn active px-6 py-2 rounded-lg font-medium transition" data-type="all">
                <i class="fas fa-border-all mr-2"></i> Semua
            </button>
            <button class="filter-btn px-6 py-2 rounded-lg font-medium transition" data-type="naskah">
                <i class="fas fa-book mr-2"></i> Naskah
            </button>
            <button class="filter-btn px-6 py-2 rounded-lg font-medium transition" data-type="lagu">
                <i class="fas fa-music mr-2"></i> Lagu
            </button>
            <button class="filter-btn px-6 py-2 rounded-lg font-medium transition" data-type="dokumentasi">
                <i class="fas fa-video mr-2"></i> Dokumentasi
            </button>
            <button class="filter-btn px-6 py-2 rounded-lg font-medium transition" data-type="video">
                <i class="fas fa-film mr-2"></i> Video
            </button>
            <button class="filter-btn px-6 py-2 rounded-lg font-medium transition" data-type="audio">
                <i class="fas fa-headphones mr-2"></i> Audio
            </button>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                <div class="text-4xl font-bold text-orange-500 mb-2">{{ $stats['total'] }}</div>
                <div class="text-gray-600">Total Koleksi</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                <div class="text-4xl font-bold text-orange-500 mb-2">{{ $stats['naskah'] }}</div>
                <div class="text-gray-600">Naskah</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                <div class="text-4xl font-bold text-orange-500 mb-2">{{ $stats['audio_lagu'] }}</div>
                <div class="text-gray-600">Audio & Lagu</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                <div class="text-4xl font-bold text-orange-500 mb-2">{{ $stats['video_dokumentasi'] }}</div>
                <div class="text-gray-600">Video & Dokumenter</div>
            </div>
        </div>

        <!-- Library Cards -->
        <div id="libraryGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($libraries as $library)
                <div class="library-card bg-white rounded-xl shadow-sm hover:shadow-lg transition p-6"
                    data-type="{{ $library->type }}" data-title="{{ strtolower($library->title) }}"
                    data-author="{{ strtolower($library->author) }}">

                    <div class="flex items-start justify-between mb-4">
                        <div class="bg-orange-100 p-3 rounded-lg">
                            <i class="fas fa-{{ $library->type_icon }} text-orange-500 text-2xl"></i>
                        </div>
                        <span
                            class="bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full">{{ $library->type_label }}</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $library->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $library->description }}</p>

                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                        <div><span class="font-medium">Penulis:</span> {{ $library->author }}</div>
                        <div><span class="font-medium">Tahun:</span> {{ $library->year }}</div>
                        @if ($library->duration)
                            <div><span class="font-medium">Durasi:</span> {{ $library->duration }}</div>
                        @endif
                        @if ($library->pages)
                            <div><span class="font-medium">Halaman:</span> {{ $library->pages }}</div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                        <span><i class="fas fa-download mr-1"></i> <span
                                class="download-count">{{ $library->downloads }}</span></span>
                        <span><i class="fas fa-eye mr-1"></i> <span
                                class="view-count">{{ $library->views }}</span></span>
                    </div>

                    <div class="flex gap-3">
                        <button onclick="viewLibrary({{ $library->id }})"
                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition">
                            <i class="fas fa-eye mr-2"></i> Lihat
                        </button>
                        <button onclick="downloadLibrary({{ $library->id }})"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                            <i class="fas fa-download"></i> Unduh
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="noResults" class="hidden text-center py-12">
            <i class="fas fa-search text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500 text-lg">Tidak ada hasil yang ditemukan</p>
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="modal fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-8">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-orange-100 p-4 rounded-xl">
                            <i id="modalIcon" class="fas fa-book text-orange-500 text-3xl"></i>
                        </div>
                        <h2 id="modalTitle" class="text-3xl font-bold text-gray-800"></h2>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <p id="modalDescription" class="text-gray-600 mb-6 leading-relaxed bg-orange-50 p-6 rounded-xl"></p>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <span class="text-gray-500 text-sm">Penulis:</span>
                        <p id="modalAuthor" class="font-medium text-gray-800"></p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Tahun:</span>
                        <p id="modalYear" class="font-medium text-gray-800"></p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Halaman:</span>
                        <p id="modalPages" class="font-medium text-gray-800"></p>
                    </div>
                    <div class="flex items-center gap-4 text-gray-600">
                        <span><i class="fas fa-download mr-1"></i> <span id="modalDownloads"></span></span>
                        <span><i class="fas fa-eye mr-1"></i> <span id="modalViews"></span></span>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button id="modalDownloadBtn"
                        class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-download mr-2"></i> Unduh Konten
                    </button>
                    <button onclick="closeModal()"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active', 'bg-orange-500', 'text-white');
                    b.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300');
                });

                this.classList.add('active', 'bg-orange-500', 'text-white');
                this.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-300');

                filterLibraries();
            });
        });

        // Initialize button styles
        document.querySelectorAll('.filter-btn').forEach(btn => {
            if (btn.classList.contains('active')) {
                btn.classList.add('bg-orange-500', 'text-white');
            } else {
                btn.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300');
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', filterLibraries);

        function filterLibraries() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const activeType = document.querySelector('.filter-btn.active').dataset.type;
            const cards = document.querySelectorAll('.library-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const cardType = card.dataset.type;
                const cardTitle = card.dataset.title;
                const cardAuthor = card.dataset.author;

                const matchesType = activeType === 'all' || cardType === activeType;
                const matchesSearch = cardTitle.includes(searchTerm) || cardAuthor.includes(searchTerm);

                if (matchesType && matchesSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('noResults').classList.toggle('hidden', visibleCount > 0);
        }

        // View library details
        function viewLibrary(id) {
            fetch(`/library/${id}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalTitle').textContent = data.title;
                    document.getElementById('modalDescription').textContent = data.description;
                    document.getElementById('modalAuthor').textContent = data.author;
                    document.getElementById('modalYear').textContent = data.year;
                    document.getElementById('modalPages').textContent = data.pages || data.duration || '-';
                    document.getElementById('modalDownloads').textContent = data.downloads;
                    document.getElementById('modalViews').textContent = data.views;

                    const iconMap = {
                        'naskah': 'book',
                        'lagu': 'music',
                        'video': 'video',
                        'dokumentasi': 'video',
                        'audio': 'music'
                    };
                    document.getElementById('modalIcon').className =
                        `fas fa-${iconMap[data.type]} text-orange-500 text-3xl`;

                    document.getElementById('modalDownloadBtn').onclick = () => downloadLibrary(id);

                    // Update view count in card
                    const card = document.querySelector(`[data-type="${data.type}"]`);
                    if (card) {
                        const viewCount = card.querySelector('.view-count');
                        if (viewCount) {
                            viewCount.textContent = data.views;
                        }
                    }

                    document.getElementById('detailModal').classList.add('active');
                })
                .catch(error => console.error('Error:', error));
        }

        // Download library
        function downloadLibrary(id) {
            fetch(`/library/${id}/download`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.blob();
                    }
                    throw new Error('Download failed');
                })
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `library-${id}`;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);

                    // Update download count
                    setTimeout(() => {
                        fetch(`/library/${id}`)
                            .then(response => response.json())
                            .then(data => {
                                const card = document.querySelector(
                                    `button[onclick="downloadLibrary(${id})"]`).closest('.library-card');
                                if (card) {
                                    const downloadCount = card.querySelector('.download-count');
                                    if (downloadCount) {
                                        downloadCount.textContent = data.downloads;
                                    }
                                }

                                const modalDownloads = document.getElementById('modalDownloads');
                                if (modalDownloads) {
                                    modalDownloads.textContent = data.downloads;
                                }
                            });
                    }, 500);
                })
                .catch(error => {
                    console.error('Download error:', error);
                    alert('Gagal mengunduh file. Silakan coba lagi.');
                });
        }

        // Close modal
        function closeModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        // Close modal on outside click
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>

</html>
