@include('components.head')

@include('components.navbar')

<div class="container-kolaborasi">
    <div class="hero-section-kolaborasi">
        <h1 class="hero-title-kolaborasi">Kolaborasi Digital Pendalungan</h1>
        <p class="hero-description-kolaborasi">Platform untuk komunitas upload, berbagi, dan berkolaborasi dalam
            karya seni digital. Tari, musik, puisi, dokumenter - semua bentuk ekspresi budaya Pendalungan.</p>
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
            <a href="{{ route('kolaborasi.index') }}"
                class="filter-tab {{ $category == 'semua' ? 'active' : '' }}">Semua</a>
            <a href="{{ route('kolaborasi.index', ['category' => 'tari']) }}"
                class="filter-tab {{ $category == 'tari' ? 'active' : '' }}">Tari</a>
            <a href="{{ route('kolaborasi.index', ['category' => 'musik']) }}"
                class="filter-tab {{ $category == 'musik' ? 'active' : '' }}">Musik</a>
            <a href="{{ route('kolaborasi.index', ['category' => 'puisi']) }}"
                class="filter-tab {{ $category == 'puisi' ? 'active' : '' }}">Puisi</a>
            <a href="{{ route('kolaborasi.index', ['category' => 'dokumenter']) }}"
                class="filter-tab {{ $category == 'dokumenter' ? 'active' : '' }}">Dokumenter</a>
            <a href="{{ route('kolaborasi.index', ['category' => 'fotografi']) }}"
                class="filter-tab {{ $category == 'fotografi' ? 'active' : '' }}">Fotografi</a>
            <a href="{{ route('kolaborasi.index', ['category' => 'kerajinan']) }}"
                class="filter-tab {{ $category == 'kerajinan' ? 'active' : '' }}">Kerajinan</a>
        </div>
        @auth
        <button class="upload-btn" onclick="openUploadModal()">
            <p><strong>+</strong></p>
            <p>Upload Karya</p>
        </button>
        @endauth
    </div>

    @if($featuredKaryas->count() > 0)
    <div class="featured-section-kolaborasi">
        <h2 class="section-title-kolaborasi">Karya Unggulan</h2>
        <div class="content-grid-kolaborasi">
            @foreach($featuredKaryas as $karya)
            <div class="content-card-kolaborasi" data-karya-id="{{ $karya->id }}">
                <div class="card-content-kolaborasi">
                    <div class="card-icon-kolaborasi">
                        @if($karya->file_type == 'video')
                        <i class="bi bi-play-circle-fill"></i>
                        @elseif($karya->file_type == 'audio')
                        <i class="bi bi-music-note-beamed"></i>
                        @elseif($karya->file_type == 'image')
                        <i class="bi bi-image-fill"></i>
                        @else
                        <i class="bi bi-file-earmark-text-fill"></i>
                        @endif
                    </div>
                    <div class="card-badge badge-{{ $karya->category }}-kolaborasi">{{ ucfirst($karya->category) }}
                    </div>
                    <h3 class="card-title-kolaborasi">{{ $karya->title }}</h3>
                    <p class="card-description-kolaborasi">{{ Str::limit($karya->description, 100) }}</p>
                    <div class="card-collaborators-kolaborasi">
                        <span>
                            <i class="bi bi-person-fill"></i> {{ $karya->user->name }}
                            @foreach($karya->collaborators as $collab)
                            <i class="bi bi-person-fill"></i> {{ $collab->name }}
                            @endforeach
                        </span>
                    </div>
                    <div class="card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span><i class="bi bi-eye-fill"></i> {{ $karya->views }}</span>
                            <span><i class="bi bi-hand-thumbs-up-fill"></i> {{ $karya->likes }}</span>
                            <span><i class="bi bi-chat-fill"></i> {{ $karya->comments->count() }}</span>
                        </div>
                        <span>{{ $karya->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="card-actions-kolaborasi">
                        <button class="btn btn-primary-kolaborasi" onclick="viewKarya({{ $karya->id }})">
                            <i class="bi bi-eye-fill"></i> Lihat
                        </button>
                        <a href="{{ route('kolaborasi.download', $karya->id) }}" class="btn btn-secondary-kolaborasi">
                            <i class="bi bi-download"></i> Unduh
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="all-works-section-kolaborasi">
        <h2 class="section-title-kolaborasi">Semua Karya</h2>
        <div class="all-works-grid-kolaborasi">
            @forelse($allKaryas as $karya)
            <div class="small-card-kolaborasi" data-karya-id="{{ $karya->id }}">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi">
                        @if($karya->file_type == 'video')
                        <i class="bi bi-play-circle-fill"></i>
                        @elseif($karya->file_type == 'audio')
                        <i class="bi bi-music-note-beamed"></i>
                        @elseif($karya->file_type == 'image')
                        <i class="bi bi-image-fill"></i>
                        @else
                        <i class="bi bi-file-text-fill"></i>
                        @endif
                    </div>
                    <div class="small-card-badge badge-{{ $karya->category }}-kolaborasi">{{ ucfirst($karya->category)
                        }}</div>
                    <h3 class="small-card-title-kolaborasi">{{ $karya->title }}</h3>
                    <p class="small-card-description-kolaborasi">{{ Str::limit($karya->description, 80) }}</p>
                    <div class="small-card-meta-kolaborasi">oleh {{ $karya->user->name }}</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span><i class="bi bi-eye-fill"></i> {{ $karya->views }}</span>
                            <span><i class="bi bi-hand-thumbs-up-fill"></i> {{ $karya->likes }}</span>
                            <span><i class="bi bi-chat-fill"></i> {{ $karya->comments->count() }}</span>
                        </div>
                        <span>{{ $karya->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi"
                            onclick="viewKarya({{ $karya->id }})">Lihat</button>
                        <a href="{{ route('kolaborasi.download', $karya->id) }}"
                            class="small-btn small-btn-secondary-kolaborasi">
                            <i class="bi bi-download"></i> Unduh
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p>Belum ada karya yang tersedia.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $allKaryas->links() }}
        </div>
    </div>

    <div class="collaboration-cta-kolaborasi">
        <div class="cta-icon-kolaborasi"><i class="bi bi-link-45deg"></i></div>
        <h2 class="cta-title-kolaborasi">Siap Berkolaborasi?</h2>
        <p class="cta-description-kolaborasi">Bergabunglah dengan komunitas kreatif dan ciptakan karya seni digital
            yang menginspirasi!</p>
        <div class="cta-buttons-kolaborasi">
            @auth
            <a onclick="openUploadModal()" class="cta-btn cta-btn-primary-kolaborasi">
                <i class="bi bi-cloud-upload-fill"></i> Upload Karya
            </a>
            @else
            <a href="{{ route('login') }}" class="cta-btn cta-btn-secondary-kolaborasi">Login untuk Upload</a>
            @endauth
        </div>
    </div>
</div>

{{-- Modal untuk upload --}}
@auth
<div class="modal-overlay-upload" id="modalUpload">
    <div class="modal-container-upload">
        <button class="modal-close-btn-upload" onclick="closeUploadModal()">×</button>
        <div class="modal-content-upload">
            <h2 class="modal-title-upload">Upload Karya Baru</h2>
            <p class="modal-subtitle-upload">Bagikan karya seni digital Anda dengan komunitas Pendalungan</p>

            <form action="{{ route('kolaborasi.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm"
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
                            accept="image/*,video/*,audio/*,.pdf" required>
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
@endauth

{{-- Modal untuk view detail karya --}}
<div class="modal-overlay-kolaborasi" id="modalKarya">
    <div class="modal-container-kolaborasi">
        <button class="modal-close-btn-kolaborasi" onclick="closeModal()">×</button>
        <div class="modal-content-kolaborasi" id="modalContentArea">
            {{-- Content will be loaded dynamically via AJAX --}}
            <div class="text-center py-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

<script>
    // Function untuk view karya detail
function viewKarya(karyaId) {
    const modal = document.getElementById('modalKarya');
    const modalContent = document.getElementById('modalContentArea');
    
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Fetch data karya via AJAX
    fetch(`/kolaborasi/${karyaId}`)
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                const data = result.data;
                modalContent.innerHTML = generateModalContent(data);
                
                // Initialize like button if user is authenticated
                @auth
                initializeLikeButton(karyaId, data.is_liked);
                @endauth
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalContent.innerHTML = '<p class="text-center text-danger">Gagal memuat data karya.</p>';
        });
}

function generateModalContent(data) {
    let mediaContent = '';
    
    // Generate media content based on file type
    if (data.file_type === 'video') {
        mediaContent = `
            <div class="modal-video-container-kolaborasi active">
                <video controls style="width: 100%; max-height: 500px;">
                    <source src="${data.file_path}" type="video/mp4">
                    Browser Anda tidak mendukung video player.
                </video>
            </div>
        `;
    } else if (data.file_type === 'audio') {
        mediaContent = `
            <div class="modal-audio-container-kolaborasi active">
                <div class="modal-audio-icon-kolaborasi">
                    <i class="bi bi-volume-up-fill"></i>
                </div>
                <audio controls>
                    <source src="${data.file_path}" type="audio/mpeg">
                    Browser Anda tidak mendukung audio player.
                </audio>
            </div>
        `;
    } else if (data.file_type === 'image') {
        mediaContent = `
            <div class="modal-gallery-container-kolaborasi active">
                <img src="${data.file_path}" alt="${data.title}" style="width: 100%; max-height: 500px; object-fit: contain;">
            </div>
        `;
    } else {
        mediaContent = `
            <div class="modal-text-container-kolaborasi active">
                <div class="modal-text-header-kolaborasi">
                    <i class="bi bi-file-text-fill"></i>
                    <span>Dokumen</span>
                </div>
            </div>
        `;
    }
    
    // Generate collaborators list
    const collaboratorsList = data.collaborators.map(collab => 
        `<span class="modal-collaborator-item-kolaborasi">${collab.name}</span>`
    ).join('');
    
    return `
        <div class="modal-header-kolaborasi">
            <h2 class="modal-title-kolaborasi">${data.title}</h2>
            <div class="modal-badge-kolaborasi badge-${data.category}-kolaborasi">${data.category}</div>
        </div>

        ${mediaContent}

        <p class="modal-description-kolaborasi">${data.description}</p>

        <div class="modal-collaborators-section-kolaborasi">
            <h4>Dibuat oleh:</h4>
            <div class="modal-collaborators-list-kolaborasi">
                <span class="modal-collaborator-item-kolaborasi">${data.user.name}</span>
                ${collaboratorsList}
            </div>
        </div>

        <div class="modal-stats-section-kolaborasi">
            <div class="modal-stats-left-kolaborasi">
                <div class="modal-stat-item-kolaborasi">
                    <i class="bi bi-eye-fill"></i>
                    <span>${data.views}</span>
                    <span>views</span>
                </div>
                <div class="modal-stat-item-kolaborasi">
                    <i class="bi bi-hand-thumbs-up-fill"></i>
                    <span id="likesCount">${data.likes}</span>
                    <span>likes</span>
                </div>
                <div class="modal-stat-item-kolaborasi">
                    <i class="bi bi-chat-fill"></i>
                    <span>${data.comments.length}</span>
                    <span>comments</span>
                </div>
            </div>
            <div class="modal-time-kolaborasi">${data.created_at}</div>
        </div>

        <div class="modal-actions-kolaborasi">
            <a href="/kolaborasi/${data.id}/download" class="modal-btn-kolaborasi modal-btn-download-kolaborasi">
                <i class="bi bi-download"></i>
                Download Karya
            </a>
            @auth
            <button class="modal-btn-kolaborasi modal-btn-favorite-kolaborasi" id="likeBtn">
                <i class="bi bi-heart"></i>
                <span id="likeBtnText">Favorit</span>
            </button>
            @endauth
        </div>

        <div class="modal-comments-section" style="margin-top: 2rem;">
            <h4>Komentar (${data.comments.length})</h4>
            <div id="commentsList">
                ${data.comments.map(comment => `
                    <div class="comment-item" style="padding: 1rem; border-bottom: 1px solid #eee;">
                        <strong>${comment.user_name}</strong>
                        <small style="color: #666;">${comment.created_at}</small>
                        <p style="margin: 0.5rem 0 0 0;">${comment.comment}</p>
                    </div>
                `).join('')}
            </div>
            
            @auth
            <form id="commentForm" style="margin-top: 1rem;">
                <textarea id="commentInput" class="form-textarea-upload" placeholder="Tulis komentar..." rows="3" required></textarea>
                <button type="submit" class="btn-upload-submit" style="margin-top: 0.5rem;">
                    <i class="bi bi-send"></i> Kirim Komentar
                </button>
            </form>
            @endauth
        </div>
    `;
}

@auth
function initializeLikeButton(karyaId, isLiked) {
    const likeBtn = document.getElementById('likeBtn');
    const likeBtnText = document.getElementById('likeBtnText');
    const likesCount = document.getElementById('likesCount');
    
    if (isLiked) {
        likeBtn.classList.add('liked');
        likeBtn.querySelector('i').classList.remove('bi-heart');
        likeBtn.querySelector('i').classList.add('bi-heart-fill');
        likeBtnText.textContent = 'Difavoritkan';
    }
    
    likeBtn.addEventListener('click', function() {
        fetch(`/kolaborasi/${karyaId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                likesCount.textContent = result.likes_count;
                
                if (result.liked) {
                    likeBtn.classList.add('liked');
                    likeBtn.querySelector('i').classList.remove('bi-heart');
                    likeBtn.querySelector('i').classList.add('bi-heart-fill');
                    likeBtnText.textContent = 'Difavoritkan';
                } else {
                    likeBtn.classList.remove('liked');
                    likeBtn.querySelector('i').classList.remove('bi-heart-fill');
                    likeBtn.querySelector('i').classList.add('bi-heart');
                    likeBtnText.textContent = 'Favorit';
                }
            }
        })
        .catch(error => console.error('Error:', error));
    });
    
    // Comment form handler
    const commentForm = document.getElementById('commentForm');
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const commentInput = document.getElementById('commentInput');
            const comment = commentInput.value;
            
            fetch(`/kolaborasi/${karyaId}/comment`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ comment: comment })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    const commentsList = document.getElementById('commentsList');
                    const newComment = `
                        <div class="comment-item" style="padding: 1rem; border-bottom: 1px solid #eee;">
                            <strong>${result.comment.user_name}</strong>
                            <small style="color: #666;">${result.comment.created_at}</small>
                            <p style="margin: 0.5rem 0 0 0;">${result.comment.comment}</p>
                        </div>
                    `;
                    commentsList.insertAdjacentHTML('beforeend', newComment);
                    commentInput.value = '';
                    
                    // Update comment count
                    const commentCount = commentsList.parentElement.querySelector('h4');
                    const currentCount = parseInt(commentCount.textContent.match(/\d+/)[0]);
                    commentCount.textContent = `Komentar (${currentCount + 1})`;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
}
@endauth

function closeModal() {
    const modal = document.getElementById('modalKarya');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

@auth
function openUploadModal() {
    const modal = document.getElementById('modalUpload');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeUploadModal() {
    const modal = document.getElementById('modalUpload');
    modal.classList.remove('active');
    document.body.style.overflow = '';
    document.getElementById('uploadForm').reset();
    document.getElementById('fileStatus').textContent = 'No file chosen';
}

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const fileStatus = document.getElementById('fileStatus');
    
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                fileStatus.textContent = e.target.files[0].name;
            } else {
                fileStatus.textContent = 'No file chosen';
            }
        });
    }
    
    const modalUpload = document.getElementById('modalUpload');
    if (modalUpload) {
        modalUpload.addEventListener('click', function(e) {
            if (e.target === this) {
                closeUploadModal();
            }
        });
    }
});
@endauth

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
        @auth
        closeUploadModal();
        @endauth
    }
});

// Close modal on overlay click
document.getElementById('modalKarya').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>