@include('components.head')
@include('components.navbar')

<div class="container-kolaborasi">
    @if(session('success'))
    <div class="alert alert-success"
        style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
        <i class="bi bi-check-circle-fill"></i>
        <strong>Sukses!</strong> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger"
        style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <strong>Error!</strong> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger"
        style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <strong>Terjadi Kesalahan:</strong>
        <ul style="margin: 10px 0 0 20px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="hero-section-kolaborasi">
        <h1 class="hero-title-kolaborasi">Kolaborasi Digital Pendalungan</h1>
        <p class="hero-description-kolaborasi">Platform untuk komunitas upload, berbagi, dan berkolaborasi dalam karya
            seni digital.</p>
    </div>

    <div class="stats-grid-kolaborasi">
        <div class="stat-item-kolaborasi">
            <div class="stat-icon-kolaborasi"><i class="bi bi-share-fill"></i></div>
            <div class="stat-number-kolaborasi">{{ $stats['total_karya'] }}</div>
            <div class="stat-label-kolaborasi">Total Karya</div>
        </div>
        <div class="stat-item-kolaborasi">
            <div class="stat-icon-kolaborasi"><i class="bi bi-people-fill"></i></div>
            <div class="stat-number-kolaborasi">{{ $stats['active_collaborators'] }}</div>
            <div class="stat-label-kolaborasi">Kolaborator Aktif</div>
        </div>
        <div class="stat-item-kolaborasi">
            <div class="stat-icon-kolaborasi"><i class="bi bi-download"></i></div>
            <div class="stat-number-kolaborasi">{{ number_format($stats['downloads_month']) }}</div>
            <div class="stat-label-kolaborasi">Download Bulan Ini</div>
        </div>
        <div class="stat-item-kolaborasi">
            <div class="stat-icon-kolaborasi"><i class="bi bi-heart-fill"></i></div>
            <div class="stat-number-kolaborasi">{{ number_format($stats['total_likes']) }}</div>
            <div class="stat-label-kolaborasi">Karya Difavoritkan</div>
        </div>
    </div>
    <div class="filter-upload-section">
        <div class="filter-tabs">
            <i class="bi bi-funnel"></i>
            <!-- PERBAIKAN: Gunakan route dengan parameter yang benar -->
            <a href="{{ route('kolaborasi.index') }}" class="filter-tab {{ $category == 'semua' ? 'active' : '' }}"
                data-category="semua">Semua</a>
            <a href="{{ route('kolaborasi.category', ['category' => 'tari']) }}"
                class="filter-tab {{ $category == 'tari' ? 'active' : '' }}" data-category="tari">Tari</a>
            <a href="{{ route('kolaborasi.category', ['category' => 'musik']) }}"
                class="filter-tab {{ $category == 'musik' ? 'active' : '' }}" data-category="musik">Musik</a>
            <a href="{{ route('kolaborasi.category', ['category' => 'puisi']) }}"
                class="filter-tab {{ $category == 'puisi' ? 'active' : '' }}" data-category="puisi">Puisi</a>
            <a href="{{ route('kolaborasi.category', ['category' => 'dokumenter']) }}"
                class="filter-tab {{ $category == 'dokumenter' ? 'active' : '' }}"
                data-category="dokumenter">Dokumenter</a>
            <a href="{{ route('kolaborasi.category', ['category' => 'fotografi']) }}"
                class="filter-tab {{ $category == 'fotografi' ? 'active' : '' }}"
                data-category="fotografi">Fotografi</a>
            <a href="{{ route('kolaborasi.category', ['category' => 'kerajinan']) }}"
                class="filter-tab {{ $category == 'kerajinan' ? 'active' : '' }}"
                data-category="kerajinan">Kerajinan</a>
        </div>
        <button class="upload-btn" onclick="openUploadModal()">
            <p><strong>+</strong></p>
            <p>Upload Karya</p>
        </button>
    </div>

    <!-- Content Area -->
    <div id="contentArea">
        <!-- Karya Unggulan -->
        @if($featuredKaryas->count() > 0)
        <div class="featured-section-kolaborasi">
            <h2 class="section-title-kolaborasi">
                @if($category == 'semua')
                Karya Unggulan
                @else
                Karya Unggulan {{ ucfirst($category) }}
                @endif
            </h2>
            <div class="content-grid-kolaborasi">
                @foreach($featuredKaryas as $karya)
                <div class="content-card-kolaborasi featured-card" data-karya-id="{{ $karya->id }}">
                    <div class="card-content-kolaborasi">
                        <div class="card-icon-kolaborasi">
                            @if($karya->file_type == 'video')
                            <i class="bi bi-boombox"></i>
                            @elseif($karya->file_type == 'audio')
                            <i class="bi bi-music-note-beamed"></i>
                            @elseif($karya->file_type == 'image')
                            <i class="bi bi-camera-fill"></i>
                            @else
                            <i class="bi bi-file-earmark-text-fill"></i>
                            @endif
                        </div>
                        <h3 class="card-title-kolaborasi">{{ $karya->title }}</h3>
                        <p class="card-description-kolaborasi">{{ Str::limit($karya->description, 80) }}</p>
                        <div class="card-collaborators-kolaborasi">
                            <span>
                                <i class="bi bi-person-fill"></i> {{ $karya->user->name }}
                                @foreach($karya->collaborators->take(2) as $collab)
                                <i class="bi bi-person-fill"></i> {{ $collab->name }}
                                @endforeach
                            </span>
                        </div>
                        <div class="card-stats-kolaborasi">
                            <div class="stat-icons-kolaborasi">
                                <span><i class="bi bi-eye-fill"></i> {{ number_format($karya->views) }}</span>
                                <span><i class="bi bi-hand-thumbs-up-fill"></i> {{ number_format($karya->likes)
                                    }}</span>
                                <span><i class="bi bi-download"></i> {{ number_format($karya->downloads) }}</span>
                            </div>
                            <span>{{ $karya->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="card-actions-kolaborasi">
                            <button class="btn btn-primary-kolaborasi" onclick="viewKarya({{ $karya->id }})">
                                <i class="bi bi-eye-fill"></i> Lihat
                            </button>
                            <a href="{{ route('kolaborasi.download', $karya->id) }}"
                                class="btn btn-secondary-kolaborasi" style="text-decoration: none;">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Semua Karya -->
        <div class="all-works-section-kolaborasi">
            <h2 class="section-title-kolaborasi">
                @if($category == 'semua')
                Semua Karya
                @else
                Karya {{ ucfirst($category) }}
                <small style="font-size: 0.8em; color: #666; margin-left: 10px;">
                    ({{ $allKaryas->total() }} karya ditemukan)
                </small>
                @endif
            </h2>

            @if($allKaryas->count() > 0)
            <div class="all-works-grid-kolaborasi">
                @foreach($allKaryas as $karya)
                <div class="small-card-kolaborasi" data-karya-id="{{ $karya->id }}">
                    <div class="small-card-content-kolaborasi">
                        <div class="small-card-icon-kolaborasi">
                            @if($karya->category == 'tari')
                            <i class="bi bi-boombox"></i>
                            @elseif($karya->category == 'musik')
                            <i class="bi bi-music-note-beamed"></i>
                            @elseif($karya->category == 'puisi')
                            <i class="bi bi-file-text-fill"></i>
                            @elseif($karya->category == 'dokumenter')
                            <i class="bi bi-film"></i>
                            @elseif($karya->category == 'fotografi')
                            <i class="bi bi-camera-fill"></i>
                            @elseif($karya->category == 'kerajinan')
                            <i class="bi bi-scissors"></i>
                            @endif
                        </div>

                        <div class="small-card-badge badge-{{ $karya->category }}-kolaborasi">
                            {{ ucfirst($karya->category) }}
                        </div>
                        <h3 class="small-card-title-kolaborasi">{{ $karya->title }}</h3>
                        <p class="small-card-description-kolaborasi">{{ Str::limit($karya->description, 100) }}</p>
                        <div class="small-card-meta-kolaborasi">
                            oleh {{ $karya->user->name }}
                            @if($karya->collaborators->count() > 0)
                            +{{ $karya->collaborators->count() }}
                            @endif
                        </div>
                        <div class="small-card-stats-kolaborasi">
                            <div class="stat-icons-kolaborasi">
                                <span><i class="bi bi-eye-fill"></i> {{ number_format($karya->views) }}</span>
                                <span><i class="bi bi-hand-thumbs-up-fill"></i> {{ number_format($karya->likes)
                                    }}</span>
                                <span><i class="bi bi-download"></i> {{ number_format($karya->downloads) }}</span>
                            </div>
                            <span>{{ $karya->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="small-card-actions-kolaborasi">
                            <button class="small-btn small-btn-primary-kolaborasi"
                                onclick="viewKarya({{ $karya->id }})">
                                Lihat
                            </button>
                            <a href="{{ route('kolaborasi.download', $karya->id) }}"
                                class="small-btn small-btn-secondary-kolaborasi">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div style="text-align: center; padding: 60px; background: #f8f9fa; border-radius: 12px; margin-top: 20px;">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc; margin-bottom: 15px;"></i>
                <h3 style="color: #666; margin-bottom: 10px;">Belum ada karya</h3>
                <p style="color: #888;">Tidak ada karya dalam kategori <strong>{{ ucfirst($category) }}</strong></p>
                <button class="upload-btn" onclick="openUploadModal()" style="margin-top: 20px;">
                    <p><strong>+</strong></p>
                    <p>Upload Karya Pertama</p>
                </button>
            </div>
            @endif
        </div>

    </div>

    <!-- CTA Section -->
    <div class="collaboration-cta-kolaborasi">
        <div class="cta-icon-kolaborasi"><i class="bi bi-link-45deg"></i></div>
        <h2 class="cta-title-kolaborasi">Siap Berkolaborasi?</h2>
        <p class="cta-description-kolaborasi">Bergabunglah dengan komunitas kreatif dan ciptakan karya seni digital yang
            menginspirasi!</p>
        <div class="cta-buttons-kolaborasi">
            <a onclick="openUploadModal()" class="cta-btn cta-btn-primary-kolaborasi">
                <i class="bi bi-cloud-upload-fill"></i> Upload Karya
            </a>
            <a href="#" class="cta-btn cta-btn-secondary-kolaborasi">Daftar Sekarang</a>
        </div>
    </div>
</div>

<!-- Modal Detail Karya -->
<div class="modal-overlay-kolaborasi" id="modalKarya">
    <div class="modal-container-kolaborasi">
        <button class="modal-close-btn-kolaborasi" onclick="closeModal()">×</button>

        <div class="modal-content-kolaborasi">
            <!-- Loading Indicator -->
            <div id="modalLoading" class="modal-loading">
                <div class="loading-spinner"></div>
                <p>Memuat karya...</p>
            </div>

            <!-- Content (hidden by default) -->
            <div id="modalContent" style="display: none;">
                <div class="modal-header-kolaborasi">
                    <h2 class="modal-title-kolaborasi" id="modalTitle"></h2>
                    <div class="modal-badge-kolaborasi" id="modalBadge"></div>
                </div>

                <div class="modal-video-container-kolaborasi" id="modalVideoContainer">
                </div>

                <div class="modal-audio-container-kolaborasi" id="modalAudioContainer">
                    <div class="modal-audio-icon-kolaborasi">
                        <i class="bi bi-volume-up-fill"></i>
                    </div>
                    <audio controls id="modalAudioPlayer">
                        <source src="" type="audio/mpeg">
                        Browser Anda tidak mendukung audio player.
                    </audio>
                    <p class="modal-audio-title-kolaborasi" id="modalAudioTitle"></p>
                </div>

                <div class="modal-text-container-kolaborasi" id="modalTextContainer">
                    <!-- Document content will be dynamically inserted -->
                </div>

                <div class="modal-gallery-container-kolaborasi" id="modalGalleryContainer">
                    <img id="modalImage" src="" alt="" style="max-width: 100%; height: auto; border-radius: 8px;">
                </div>

                <div class="modal-craft-container-kolaborasi" id="modalCraftContainer">
                    <i class="bi bi-image-fill"></i>
                    <span id="modalCraftTitle"></span>
                </div>

                <p class="modal-description-kolaborasi" id="modalDescription"></p>

                <div class="modal-collaborators-section-kolaborasi">
                    <h4>Kolaborator:</h4>
                    <div class="modal-collaborators-list-kolaborasi" id="modalCollaborators"></div>
                </div>

                <div class="modal-stats-section-kolaborasi">
                    <div class="modal-stats-left-kolaborasi">
                        <div class="modal-stat-item-kolaborasi">
                            <i class="bi bi-eye-fill"></i>
                            <span id="modalViews">0</span>
                            <span>views</span>
                        </div>
                        <div class="modal-stat-item-kolaborasi">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                            <span id="modalLikes">0</span>
                            <span>likes</span>
                        </div>
                        <div class="modal-stat-item-kolaborasi">
                            <i class="bi bi-download"></i>
                            <span id="modalDownloads">0</span>
                            <span>downloads</span>
                        </div>
                    </div>
                    <div class="modal-time-kolaborasi" id="modalTime"></div>
                </div>

                <div class="modal-actions-kolaborasi">
                    <a href="#" id="modalDownloadBtn" class="modal-btn-kolaborasi modal-btn-download-kolaborasi">
                        <i class="bi bi-download"></i>
                        Download Karya
                    </a>
                    <button class="modal-btn-kolaborasi modal-btn-favorite-kolaborasi" id="modalLikeBtn"
                        onclick="toggleLike()">
                        <i class="bi bi-heart"></i>
                        <span id="likeText">Favorit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload -->
<div class="modal-overlay-upload" id="modalUpload">
    <div class="modal-container-upload">
        <button class="modal-close-btn-upload" onclick="closeUploadModal()">×</button>

        <div class="modal-content-upload">
            <h2 class="modal-title-upload">Upload Karya Baru</h2>
            <p class="modal-subtitle-upload">Bagikan karya seni digital Anda dengan komunitas Pendalungan</p>

            <form id="uploadForm" action="{{ route('kolaborasi.store') }}" method="POST" enctype="multipart/form-data"
                class="upload-form">
                @csrf
                <div class="form-group-upload">
                    <label class="form-label-upload">Judul Karya</label>
                    <input type="text" name="title" class="form-input-upload" placeholder="Masukkan judul karya"
                        required>
                </div>

                <div class="form-group-upload">
                    <label class="form-label-upload">Kategori</label>
                    <select name="category" class="form-select-upload" required>
                        <option value="">Pilih kategori</option>
                        <option value="tari">Tari</option>
                        <option value="musik">Musik</option>
                        <option value="puisi">Puisi</option>
                        <option value="dokumenter">Dokumenter</option>
                        <option value="fotografi">Fotografi</option>
                        <option value="kerajinan">Kerajinan</option>
                    </select>
                </div>

                <div class="form-group-upload">
                    <label class="form-label-upload">Deskripsi</label>
                    <textarea name="description" class="form-textarea-upload" placeholder="Deskripsikan karya Anda"
                        rows="4" required></textarea>
                </div>

                <div class="form-group-upload">
                    <label class="form-label-upload">File Karya</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="file" id="fileInput" class="file-input-upload"
                            accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.txt" required>
                        <label for="fileInput" class="file-label-upload">
                            <span id="fileName">Choose File</span>
                            <span id="fileStatus">No file chosen</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-upload-submit">
                    <i class="bi bi-cloud-upload-fill"></i>
                    Upload Karya
                </button>
            </form>
        </div>
    </div>
</div>

@include('components.footer')
<script>
    let currentKaryaId = null;
let currentKaryaData = null;

// View Karya Detail
function viewKarya(id) {
    currentKaryaId = id;

    // Show loading state
    const modal = document.getElementById('modalKarya');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    // Show loading indicator
    showModalLoading(true);

    fetch(`/kolaborasi/${id}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Server returned non-JSON response');
        }
        return response.json();
    })
    .then(result => {
        if (result.success) {
            currentKaryaData = result.data;
            displayKaryaModal(result.data);
        } else {
            throw new Error(result.message || 'Gagal memuat detail karya');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        closeModal();
        showError('Gagal memuat detail karya: ' + error.message);
    })
    .finally(() => {
        showModalLoading(false);
    });
}

function showModalLoading(show) {
    const loadingElement = document.getElementById('modalLoading');
    const contentElement = document.getElementById('modalContent');

    if (loadingElement && contentElement) {
        if (show) {
            loadingElement.style.display = 'flex';
            contentElement.style.display = 'none';
        } else {
            loadingElement.style.display = 'none';
            contentElement.style.display = 'block';
        }
    }
}

function displayKaryaModal(data) {
    const modal = document.getElementById('modalKarya');

    // Reset semua container
    const containers = [
        'modalVideoContainer',
        'modalAudioContainer',
        'modalTextContainer',
        'modalGalleryContainer',
        'modalCraftContainer'
    ];

    containers.forEach(containerId => {
        const container = document.getElementById(containerId);
        if (container) container.classList.remove('active');
    });

    // Set basic info
    setElementText('modalTitle', data.title);
    setElementText('modalDescription', data.description);
    setElementText('modalViews', data.views);
    setElementText('modalLikes', data.likes);
    setElementText('modalDownloads', data.downloads);
    setElementText('modalTime', data.created_at);

    // Set badge
    const badgeElement = document.getElementById('modalBadge');
    if (badgeElement) {
        badgeElement.textContent = data.file_type.toUpperCase();
        badgeElement.className = 'modal-badge-kolaborasi badge-' + data.file_type + '-kolaborasi';
    }

    // Set collaborators
    const collabContainer = document.getElementById('modalCollaborators');
    if (collabContainer) {
        let collabHTML = `<span class="modal-collaborator-item-kolaborasi">${data.user.name}</span>`;
        if (data.collaborators && data.collaborators.length > 0) {
            data.collaborators.forEach(collab => {
                collabHTML += `<span class="modal-collaborator-item-kolaborasi">${collab.name}</span>`;
            });
        }
        collabContainer.innerHTML = collabHTML;
    }

    // Set download button
    const downloadBtn = document.getElementById('modalDownloadBtn');
    if (downloadBtn) {
        downloadBtn.href = `/kolaborasi/${data.id}/download`;
    }

    // Set like button
    const likeBtn = document.getElementById('modalLikeBtn');
    if (likeBtn) {
        const likeIcon = likeBtn.querySelector('i');
        const likeText = document.getElementById('likeText');

        if (likeIcon && likeText) {
            if (data.is_liked) {
                likeIcon.className = 'bi bi-heart-fill';
                likeText.textContent = 'Difavoritkan';
            } else {
                likeIcon.className = 'bi bi-heart';
                likeText.textContent = 'Favorit';
            }
        }
    }

    // Show appropriate content based on file type
    displayFileContent(data);

    // Ensure modal is visible
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function displayFileContent(data) {
    if (data.file_type === 'video') {
        displayVideoContent(data);
    } else if (data.file_type === 'audio') {
        displayAudioContent(data);
    } else if (data.file_type === 'pictures') {
        displayImageContent(data);
    } else if (data.file_type === 'document') {
        displayDocumentContent(data);
    } else {
        // Fallback for unknown file types
        displayFallbackContent(data);
    }
}

function displayVideoContent(data) {
    const videoContainer = document.getElementById('modalVideoContainer');
    if (!videoContainer) return;

    videoContainer.classList.add('active');

    // Check if it's a YouTube/external link or local file
    if (isYouTubeUrl(data.file_path) || isExternalUrl(data.file_path)) {
        videoContainer.innerHTML = `
            <div class="video-wrapper">
                <iframe
                    src="${getEmbedUrl(data.file_path)}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        `;
    } else {
        // For local video files
        videoContainer.innerHTML = `
            <div class="video-wrapper">
                <video controls>
                    <source src="${data.file_path}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        `;
    }
}

function displayAudioContent(data) {
    const audioContainer = document.getElementById('modalAudioContainer');
    if (!audioContainer) return;

    audioContainer.classList.add('active');

    const audioPlayer = document.getElementById('modalAudioPlayer');
    const audioTitle = document.getElementById('modalAudioTitle');

    if (audioPlayer) {
        audioPlayer.src = data.file_path;
    }
    if (audioTitle) {
        audioTitle.textContent = data.title;
    }
}

function displayImageContent(data) {
    const galleryContainer = document.getElementById('modalGalleryContainer');
    if (!galleryContainer) return;

    galleryContainer.classList.add('active');

    const modalImage = document.getElementById('modalImage');
    if (modalImage) {
        modalImage.src = data.file_path;
        modalImage.alt = data.title;
    }
}

function displayDocumentContent(data) {
    const textContainer = document.getElementById('modalTextContainer');
    if (!textContainer) return;

    textContainer.classList.add('active');

    textContainer.innerHTML = `
        <div class="document-preview">
            <i class="bi bi-file-earmark-text document-icon"></i>
            <h3>${data.title}</h3>
            <p class="document-description">${data.description}</p>
            <div class="document-actions">
                <a href="${data.file_path}" target="_blank" class="modal-btn-kolaborasi modal-btn-primary-kolaborasi">
                    <i class="bi bi-eye"></i> Lihat Dokumen
                </a>
                <a href="/kolaborasi/${data.id}/download" class="modal-btn-kolaborasi modal-btn-secondary-kolaborasi">
                    <i class="bi bi-download"></i> Download
                </a>
            </div>
        </div>
    `;
}

function displayFallbackContent(data) {
    const textContainer = document.getElementById('modalTextContainer');
    if (!textContainer) return;

    textContainer.classList.add('active');

    textContainer.innerHTML = `
        <div class="fallback-preview">
            <i class="bi bi-file-earmark"></i>
            <h3>${data.title}</h3>
            <p>File type: ${data.file_type}</p>
            <a href="${data.file_path}" target="_blank" class="modal-btn-kolaborasi modal-btn-primary-kolaborasi">
                <i class="bi bi-box-arrow-up-right"></i> Buka File
            </a>
        </div>
    `;
}

function toggleLike() {
    if (!currentKaryaId) return;

    const likeBtn = document.getElementById('modalLikeBtn');
    if (likeBtn) {
        likeBtn.disabled = true;
    }

    fetch(`/kolaborasi/${currentKaryaId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(result => {
        if (result.success) {
            updateLikeUI(result.liked, result.likes_count);
        } else {
            throw new Error(result.message || 'Gagal memproses like');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Gagal memproses like: ' + error.message);
    })
    .finally(() => {
        if (likeBtn) {
            likeBtn.disabled = false;
        }
    });
}

function updateLikeUI(liked, likesCount) {
    const likeBtn = document.getElementById('modalLikeBtn');
    const likeIcon = likeBtn ? likeBtn.querySelector('i') : null;
    const likeText = document.getElementById('likeText');
    const likesCountElement = document.getElementById('modalLikes');

    if (likeIcon && likeText) {
        if (liked) {
            likeIcon.className = 'bi bi-heart-fill';
            likeText.textContent = 'Difavoritkan';
        } else {
            likeIcon.className = 'bi bi-heart';
            likeText.textContent = 'Favorit';
        }
    }

    if (likesCountElement) {
        likesCountElement.textContent = likesCount;
    }
}

function closeModal() {
    const modal = document.getElementById('modalKarya');
    if (modal) {
        modal.classList.remove('active');
    }
    document.body.style.overflow = '';

    // Clean up media
    cleanupMedia();

    currentKaryaId = null;
    currentKaryaData = null;
}

function cleanupMedia() {
    // Stop and clean video iframes
    const videoIframes = document.querySelectorAll('#modalVideoContainer iframe');
    videoIframes.forEach(iframe => {
        iframe.src = '';
    });

    // Stop and clean video elements
    const videoElements = document.querySelectorAll('#modalVideoContainer video');
    videoElements.forEach(video => {
        video.pause();
        video.src = '';
    });

    // Stop and clean audio elements
    const audioPlayer = document.getElementById('modalAudioPlayer');
    if (audioPlayer) {
        audioPlayer.pause();
        audioPlayer.src = '';
    }
}

function openUploadModal() {
    const modal = document.getElementById('modalUpload');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Reset form ketika modal dibuka
        const form = document.getElementById('uploadForm');
        if (form) {
            form.reset();
        }

        // Reset file status
        const fileStatus = document.getElementById('fileStatus');
        if (fileStatus) {
            fileStatus.textContent = 'No file chosen';
        }
    }
}

function closeUploadModal() {
    const modal = document.getElementById('modalUpload');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';

        // Jangan reset form di sini, biarkan form maintain state
    }
}

// SIMPLE FORM HANDLING - TANPA AJAX COMPLEX
function handleUploadForm() {
    const uploadForm = document.getElementById('uploadForm');
    const submitBtn = uploadForm?.querySelector('button[type="submit"]');
    const fileInput = document.getElementById('fileInput');
    const fileStatus = document.getElementById('fileStatus');

    if (uploadForm) {
        console.log('Upload form initialized');

        // File input change handler
        if (fileInput && fileStatus) {
            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    fileStatus.textContent = file.name;
                    console.log('File selected:', file.name);

                    // Validasi file type
                    validateFileType(file);
                } else {
                    fileStatus.textContent = 'No file chosen';
                }
            });
        }

        // Form submission handler - SIMPLE VERSION
        uploadForm.addEventListener('submit', function(e) {
            console.log('Form submitted normally - allowing natural form submission');

            // Just show loading, let form submit naturally
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Mengupload...';
            }

            // Biarkan form submit secara normal - TIDAK ADA preventDefault()
            // Form akan melakukan redirect natural ke server
        });
    }
}

function validateFileType(file) {
    const allowedTypes = [
        'image/jpeg', 'image/png', 'image/gif', 'image/webp',
        'video/mp4', 'video/webm', 'video/ogg',
        'audio/mpeg', 'audio/wav', 'audio/ogg',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if (!allowedTypes.includes(file.type)) {
        showError('File type tidak didukung. Silakan pilih file yang sesuai.');
        document.getElementById('fileInput').value = '';
        document.getElementById('fileStatus').textContent = 'No file chosen';
        return false;
    }

    return true;
}

// Utility functions
function setElementText(elementId, text) {
    const element = document.getElementById(elementId);
    if (element) {
        element.textContent = text;
    }
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

function isYouTubeUrl(url) {
    return url.includes('youtube.com') || url.includes('youtu.be');
}

function isExternalUrl(url) {
    try {
        return new URL(url).origin !== window.location.origin;
    } catch {
        return false;
    }
}

function getEmbedUrl(url) {
    if (url.includes('youtube.com/watch?v=')) {
        return url.replace('watch?v=', 'embed/');
    } else if (url.includes('youtu.be/')) {
        return url.replace('youtu.be/', 'youtube.com/embed/');
    }
    return url;
}

function showError(message) {
    // Simple error alert - bisa diganti dengan toast notification
    alert('Error: ' + message);
}

// Filter dan Pagination Functions
function loadPage(url) {
    console.log('Loading page:', url);

    // Show loading
    document.getElementById('contentArea').innerHTML = `
        <div style="text-align: center; padding: 60px;">
            <div class="loading-spinner" style="margin: 0 auto;"></div>
            <p>Memuat karya...</p>
        </div>
    `;

    fetch(url, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.status);
        }
        return response.json();
    })
    .then(result => {
        console.log('AJAX Response:', result);

        if (result.success) {
            document.getElementById('contentArea').innerHTML = result.html;
            window.history.pushState({}, '', url);
            updateActiveTab(result.category);
        } else {
            throw new Error('AJAX response not successful');
        }
    })
    .catch(error => {
        console.error('Error loading page:', error);
        // Fallback to normal navigation
        window.location.href = url;
    });
}

function updateActiveTab(category) {
    console.log('Updating active tab to:', category);

    // Remove active class from all tabs
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.classList.remove('active');
    });

    // Add active class to current tab
    const activeTab = document.querySelector(`.filter-tab[data-category="${category}"]`);
    if (activeTab) {
        activeTab.classList.add('active');
        console.log('Active tab updated:', activeTab);
    } else {
        console.error('Tab not found for category:', category);
        // Fallback: cari tab dengan href yang sesuai
        const currentUrl = window.location.href;
        document.querySelectorAll('.filter-tab').forEach(tab => {
            if (currentUrl.includes(tab.href)) {
                tab.classList.add('active');
                console.log('Fallback active tab:', tab);
            }
        });
    }
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - initializing all event handlers');

    // Initialize upload form handling
    handleUploadForm();

    // File input handling
    const fileInput = document.getElementById('fileInput');
    const fileStatus = document.getElementById('fileStatus');

    if (fileInput && fileStatus) {
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                fileStatus.textContent = file.name;
                console.log('File selected:', file.name);
            } else {
                fileStatus.textContent = 'No file chosen';
            }
        });
    }

    // Close modals on overlay click
    const karyaModal = document.getElementById('modalKarya');
    const uploadModal = document.getElementById('modalUpload');

    if (karyaModal) {
        karyaModal.addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    }

    if (uploadModal) {
        uploadModal.addEventListener('click', function(e) {
            if (e.target === this) closeUploadModal();
        });
    }

    // Prevent modal content click from closing modal
    const modalContents = document.querySelectorAll('.modal-content-kolaborasi, .modal-content-upload');
    modalContents.forEach(content => {
        content.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    // ESC key handler
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeUploadModal();
        }
    });

    // Filter tabs click handler
    document.addEventListener('click', function(e) {
        // Handle filter tabs
        if (e.target.closest('.filter-tab') && !e.target.closest('.filter-tab.active')) {
            e.preventDefault();
            const link = e.target.closest('.filter-tab');
            const category = link.getAttribute('data-category');
            console.log('Filter tab clicked:', category, 'URL:', link.href);
            loadPage(link.href);
        }

        // Handle pagination
        if (e.target.closest('.pagination a') && e.target.closest('.pagination a').href) {
            e.preventDefault();
            const link = e.target.closest('a');
            console.log('Pagination clicked:', link.href);
            loadPage(link.href);
        }
    });

    // Initialize active tab based on current URL
    const currentUrl = window.location.href;
    console.log('Current URL on load:', currentUrl);

    // Cari kategori dari URL
    let currentCategory = 'semua';
    if (currentUrl.includes('/category/')) {
        const match = currentUrl.match(/\/category\/([^\/\?]+)/);
        if (match) {
            currentCategory = match[1];
        }
    } else if (currentUrl.includes('category=')) {
        const urlParams = new URLSearchParams(window.location.search);
        currentCategory = urlParams.get('category') || 'semua';
    }

    console.log('Detected category:', currentCategory);
    updateActiveTab(currentCategory);
});

// Handle browser back/forward buttons
window.addEventListener('popstate', function() {
    loadPage(window.location.href);
});

// Loading spinner CSS (tambahkan di CSS Anda)
const spinnerStyle = document.createElement('style');
spinnerStyle.textContent = `
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .spin {
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .modal-loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px;
        text-align: center;
    }
`;
document.head.appendChild(spinnerStyle);
</script>
