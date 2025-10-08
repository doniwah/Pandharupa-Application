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
        <button class="upload-btn" onclick="openUploadModal()">
            <p><strong>+</strong></p>
            <p>Upload Karya</p>
        </button>
    </div>

    <div class="featured-section-kolaborasi">
        <h2 class="section-title-kolaborasi">Karya Unggulan</h2>
        <div class="content-grid-kolaborasi">
            <div class="content-card-kolaborasi">
                <div class="card-content-kolaborasi">
                    <div class="card-icon-kolaborasi"><i class="bi bi-boombox"></i></div>
                    <div class="card-badge badge-video-kolaborasi">Video</div>
                    <h3 class="card-title-kolaborasi">Kolaborasi Tari Jejer Modern</h3>
                    <p class="card-description-kolaborasi">Interpretasi modern dari tarian tradisional Jejer dengan
                        sentuhan kontemporer.</p>
                    <div class="card-collaborators-kolaborasi">
                        <span><i class="bi bi-person-fill"></i> Sari D. <i class="bi bi-person-fill"></i> Budi K. <i
                                class="bi bi-person-fill"></i> Rina M.</span>
                    </div>
                    <div class="card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span><i class="bi bi-eye-fill"></i> 1250</span>
                            <span><i class="bi bi-hand-thumbs-up-fill"></i> 89</span>
                            <span><i class="bi bi-chat-fill"></i> 45</span>
                        </div>
                        <span>3 hari lalu</span>
                    </div>
                    <div class="card-actions-kolaborasi">
                        <button class="btn btn-primary-kolaborasi"><i class="bi bi-eye-fill"></i> Lihat</button>
                        <button class="btn btn-secondary-kolaborasi"><i class="bi bi-download"></i> Unduh</button>
                    </div>
                </div>
            </div>

            <div class="content-card-kolaborasi">
                <div class="card-content-kolaborasi">
                    <div class="card-icon-kolaborasi"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <div class="card-badge badge-outstanding-kolaborasi">Outstanding</div>
                    <h3 class="card-title-kolaborasi">Dokumenter: Perajin Batik Pendalungan</h3>
                    <p class="card-description-kolaborasi">Film dokumenter tentang kehidupan dan karya para perajin
                        batik tradisional.</p>
                    <div class="card-collaborators-kolaborasi">
                        <span><i class="bi bi-person-fill"></i> Ahmad S. <i class="bi bi-person-fill"></i> Lisa P. <i
                                class="bi bi-person-fill"></i> Doni W.</span>
                    </div>
                    <div class="card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span><i class="bi bi-eye-fill"></i> 2100</span>
                            <span><i class="bi bi-hand-thumbs-up-fill"></i> 156</span>
                            <span><i class="bi bi-chat-fill"></i> 78</span>
                        </div>
                        <span>1 minggu lalu</span>
                    </div>
                    <div class="card-actions-kolaborasi">
                        <button class="btn btn-primary-kolaborasi"><i class="bi bi-eye-fill"></i> Lihat</button>
                        <button class="btn btn-secondary-kolaborasi"><i class="bi bi-download"></i> Unduh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="all-works-section-kolaborasi">
        <h2 class="section-title-kolaborasi">Semua Karya</h2>
        <div class="all-works-grid-kolaborasi">
            <div class="small-card-kolaborasi">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi"><i class="bi bi-file-text-fill"></i></div>
                    <div class="small-card-badge badge-puisi-kolaborasi">Puisi</div>
                    <h3 class="small-card-title-kolaborasi">Kumpulan Puisi: Rindu Kampung</h3>
                    <p class="small-card-description-kolaborasi">Kumpulan puisi yang menggambarkan kerinduan
                        terhadap kampung halaman dan budaya lokal.</p>
                    <div class="small-card-meta-kolaborasi">oleh Maya Ek - 1</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span><i class="bi bi-eye-fill"></i> 67</span>
                            <span><i class="bi bi-hand-thumbs-up-fill"></i> 12</span>
                            <span><i class="bi bi-chat-fill"></i> 4</span>
                        </div>
                        <span>2 minggu lalu</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi">Lihat</button>
                        <button class="small-btn small-btn-secondary-kolaborasi"><i class="bi bi-download"></i>
                            Unduh</button>
                    </div>
                </div>
            </div>

            <div class="small-card-kolaborasi">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi"><i class="bi bi-music-note-beamed"></i></div>
                    <div class="small-card-badge badge-musik-kolaborasi">Musik</div>
                    <h3 class="small-card-title-kolaborasi">Musik Fusion: Gamelan Digital</h3>
                    <p class="small-card-description-kolaborasi">Perpaduan gamelan tradisional dengan sentuhan musik
                        digital modern.</p>
                    <div class="small-card-meta-kolaborasi">oleh Iri Np</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span><i class="bi bi-eye-fill"></i> 1400</span>
                            <span><i class="bi bi-hand-thumbs-up-fill"></i> 98</span>
                            <span><i class="bi bi-chat-fill"></i> 23</span>
                        </div>
                        <span>3 minggu lalu</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi">Lihat</button>
                        <button class="small-btn small-btn-secondary-kolaborasi"><i class="bi bi-download"></i>
                            Unduh</button>
                    </div>
                </div>
            </div>

            <div class="small-card-kolaborasi">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi"><i class="bi bi-camera-fill"></i></div>
                    <div class="small-card-badge badge-foto-kolaborasi">Foto</div>
                    <h3 class="small-card-title-kolaborasi">Fotografi: Potret Kehidupan Nelayan</h3>
                    <p class="small-card-description-kolaborasi">Dokumentasi visual kehidupan sehari-hari para
                        nelayan yang melestarikan nelayan Pendalungan.</p>
                    <div class="small-card-meta-kolaborasi">oleh Ri Si</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span><i class="bi bi-eye-fill"></i> 780</span>
                            <span><i class="bi bi-hand-thumbs-up-fill"></i> 54</span>
                            <span><i class="bi bi-chat-fill"></i> 12</span>
                        </div>
                        <span>1 bulan lalu</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi">Lihat</button>
                        <button class="small-btn small-btn-secondary-kolaborasi"><i class="bi bi-download"></i>
                            Unduh</button>
                    </div>
                </div>
            </div>

            <div class="small-card-kolaborasi">
                <div class="small-card-content-kolaborasi">
                    <div class="small-card-icon-kolaborasi"><i class="bi bi-scissors"></i></div>
                    <div class="small-card-badge badge-kerajinan-kolaborasi">Kerajinan</div>
                    <h3 class="small-card-title-kolaborasi">Kerajinan: Vas Bambu Kontemporer</h3>
                    <p class="small-card-description-kolaborasi">Desain vas dari bambu dengan sentuhan modern untuk
                        dekorasi rumah.</p>
                    <div class="small-card-meta-kolaborasi">oleh Ana - 1</div>
                    <div class="small-card-stats-kolaborasi">
                        <div class="stat-icons-kolaborasi">
                            <span><i class="bi bi-eye-fill"></i> 420</span>
                            <span><i class="bi bi-hand-thumbs-up-fill"></i> 34</span>
                        </div>
                        <span>1 bulan lalu</span>
                    </div>
                    <div class="small-card-actions-kolaborasi">
                        <button class="small-btn small-btn-primary-kolaborasi">Lihat</button>
                        <button class="small-btn small-btn-secondary-kolaborasi"><i class="bi bi-download"></i>
                            Unduh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="collaboration-cta-kolaborasi">
        <div class="cta-icon-kolaborasi"><i class="bi bi-link-45deg"></i></div>
        <h2 class="cta-title-kolaborasi">Siap Berkolaborasi?</h2>
        <p class="cta-description-kolaborasi">Bergabunglah dengan komunitas kreatif dan ciptakan karya seni digital
            yang menginspirasi!</p>
        <div class="cta-buttons-kolaborasi">
            <a onclick="openUploadModal()" class="cta-btn cta-btn-primary-kolaborasi"><i class="bi bi-cloud-upload-fill"></i> Upload
                Karya</a>
            <a href="#" class="cta-btn cta-btn-secondary-kolaborasi">Daftar Sekarang</a>
        </div>
    </div>
</div>

<div class="modal-overlay-kolaborasi" id="modalKarya">
    <div class="modal-container-kolaborasi">
        <button class="modal-close-btn-kolaborasi" onclick="closeModal()">×</button>

        <div class="modal-content-kolaborasi">
            <div class="modal-header-kolaborasi">
                <h2 class="modal-title-kolaborasi" id="modalTitle">Kolaborasi Tari Jejer Modern</h2>
                <div class="modal-badge-kolaborasi badge-video-kolaborasi" id="modalBadge">Video</div>
            </div>

            <div class="modal-video-container-kolaborasi" id="modalVideoContainer">
                <iframe src=""
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            <div class="modal-audio-container-kolaborasi" id="modalAudioContainer">
                <div class="modal-audio-icon-kolaborasi">
                    <i class="bi bi-volume-up-fill"></i>
                </div>
                <audio controls id="modalAudioPlayer">
                    <source src="" type="audio/mpeg">
                    Browser Anda tidak mendukung audio player.
                </audio>
                <p class="modal-audio-title-kolaborasi" id="modalAudioTitle">Gamelan Digital Fusion - 5:24</p>
            </div>

            <div class="modal-text-container-kolaborasi" id="modalTextContainer">
                <div class="modal-text-header-kolaborasi">
                    <i class="bi bi-file-text-fill"></i>
                    <span>Puisi</span>
                </div>
                <div class="modal-text-content-kolaborasi" id="modalTextContent"></div>
            </div>

            <div class="modal-gallery-container-kolaborasi" id="modalGalleryContainer">
                <div class="modal-gallery-item-kolaborasi">
                    <i class="bi bi-image-fill"></i>
                    <span>Foto Nelayan 1</span>
                </div>
                <div class="modal-gallery-item-kolaborasi">
                    <i class="bi bi-image-fill"></i>
                    <span>Foto Nelayan 2</span>
                </div>
                <div class="modal-gallery-item-kolaborasi">
                    <i class="bi bi-image-fill"></i>
                    <span>Foto Nelayan 3</span>
                </div>
                <div class="modal-gallery-item-kolaborasi">
                    <i class="bi bi-image-fill"></i>
                    <span>Foto Nelayan 4</span>
                </div>
            </div>

            <div class="modal-craft-container-kolaborasi" id="modalCraftContainer">
                <i class="bi bi-image-fill"></i>
                <span id="modalCraftTitle">Vas Bambu Kontemporer</span>
            </div>

            <p class="modal-description-kolaborasi" id="modalDescription">
                Interpretasi modern dari tarian tradisional Jejer dengan sentuhan kontemporer.
            </p>

            <div class="modal-collaborators-section-kolaborasi">
                <h4>Kolaborator:</h4>
                <div class="modal-collaborators-list-kolaborasi" id="modalCollaborators">
                    <span class="modal-collaborator-item-kolaborasi">Sari D.</span>
                    <span class="modal-collaborator-item-kolaborasi">Budil K.</span>
                    <span class="modal-collaborator-item-kolaborasi">Rina M.</span>
                </div>
            </div>

            <div class="modal-stats-section-kolaborasi">
                <div class="modal-stats-left-kolaborasi">
                    <div class="modal-stat-item-kolaborasi">
                        <i class="bi bi-eye-fill"></i>
                        <span id="modalViews">1250</span>
                        <span>views</span>
                    </div>
                    <div class="modal-stat-item-kolaborasi">
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                        <span id="modalLikes">89</span>
                        <span>likes</span>
                    </div>
                    <div class="modal-stat-item-kolaborasi">
                        <i class="bi bi-chat-fill"></i>
                        <span id="modalComments">45</span>
                        <span>comments</span>
                    </div>
                </div>
                <div class="modal-time-kolaborasi" id="modalTime">3 hari lalu</div>
            </div>

            <div class="modal-actions-kolaborasi">
                <button class="modal-btn-kolaborasi modal-btn-download-kolaborasi">
                    <i class="bi bi-download"></i>
                    Download Karya
                </button>
                <button class="modal-btn-kolaborasi modal-btn-favorite-kolaborasi">
                    <i class="bi bi-heart"></i>
                    Favorit
                </button>
            </div>
        </div>
    </div>
</div>

@include('components.footer')
<div class="modal-overlay-upload" id="modalUpload">
    <div class="modal-container-upload">
        <button class="modal-close-btn-upload" onclick="closeUploadModal()">×</button>

        <div class="modal-content-upload">
            <h2 class="modal-title-upload">Upload Karya Baru</h2>
            <p class="modal-subtitle-upload">Bagikan karya seni digital Anda dengan komunitas Pendalungan</p>

            <form id="uploadForm" class="upload-form">
                <div class="form-group-upload">
                    <label class="form-label-upload">Judul Karya</label>
                    <input type="text" class="form-input-upload" placeholder="Masukkan judul karya" required>
                </div>

                <div class="form-group-upload">
                    <label class="form-label-upload">Kategori</label>
                    <select class="form-select-upload" required>
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
                    <textarea class="form-textarea-upload" placeholder="Deskripsikan karya Anda" rows="4"
                        required></textarea>
                </div>

                <div class="form-group-upload">
                    <label class="form-label-upload">File Karya</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="fileInput" class="file-input-upload"
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

<script>
    const filterTabs = document.querySelectorAll('.filter-tab');

filterTabs.forEach(tab => {
    tab.addEventListener('click', () => {
        filterTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
    });
});

const buttons = document.querySelectorAll('.btn, .small-btn');
buttons.forEach(btn => {
    btn.addEventListener('click', (e) => {
        btn.style.transform = 'scale(0.95)';
        setTimeout(() => {
            btn.style.transform = '';
        }, 150);
    });
});

function openModal(data) {
    const modal = document.getElementById('modalKarya');
    
    document.getElementById('modalVideoContainer').classList.remove('active');
    document.getElementById('modalAudioContainer').classList.remove('active');
    document.getElementById('modalTextContainer').classList.remove('active');
    document.getElementById('modalGalleryContainer').classList.remove('active');
    document.getElementById('modalCraftContainer').classList.remove('active');
    
    document.getElementById('modalTitle').textContent = data.title;
    document.getElementById('modalBadge').textContent = data.badge;
    document.getElementById('modalBadge').className = 'modal-badge-kolaborasi ' + data.badgeClass;
    document.getElementById('modalDescription').textContent = data.description;
    document.getElementById('modalViews').textContent = data.views;
    document.getElementById('modalLikes').textContent = data.likes;
    document.getElementById('modalComments').textContent = data.comments || '0';
    document.getElementById('modalTime').textContent = data.time;
    
    const collabContainer = document.getElementById('modalCollaborators');
    collabContainer.innerHTML = data.collaborators.map(name => 
        `<span class="modal-collaborator-item-kolaborasi">${name}</span>`
    ).join('');
    
    const contentType = data.contentType || 'video';
    
    if (contentType === 'video') {
        const videoContainer = document.getElementById('modalVideoContainer');
        videoContainer.classList.add('active');
        videoContainer.querySelector('iframe').src = data.videoUrl || 'https://www.youtube.com/embed/dQw4w9WgXcQ';
    } 
    else if (contentType === 'audio') {
        const audioContainer = document.getElementById('modalAudioContainer');
        audioContainer.classList.add('active');
        document.getElementById('modalAudioPlayer').src = data.audioUrl || '';
        document.getElementById('modalAudioTitle').textContent = data.audioTitle || 'Audio Track';
    } 
    else if (contentType === 'text' || contentType === 'puisi') {
        const textContainer = document.getElementById('modalTextContainer');
        textContainer.classList.add('active');
        document.getElementById('modalTextContent').textContent = data.textContent || '';
    } 
    else if (contentType === 'gallery' || contentType === 'foto') {
        const galleryContainer = document.getElementById('modalGalleryContainer');
        galleryContainer.classList.add('active');
        
        if (data.galleryItems) {
            galleryContainer.innerHTML = data.galleryItems.map((item, index) => `
                <div class="modal-gallery-item-kolaborasi">
                    <i class="bi bi-image-fill"></i>
                    <span>${item.title || 'Foto ' + (index + 1)}</span>
                </div>
            `).join('');
        }
    } 
    else if (contentType === 'craft' || contentType === 'kerajinan') {
        const craftContainer = document.getElementById('modalCraftContainer');
        craftContainer.classList.add('active');
        document.getElementById('modalCraftTitle').textContent = data.craftTitle || data.title;
    }
    
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('modalKarya');
    modal.classList.remove('active');
    document.body.style.overflow = '';
    
    const videoIframe = document.querySelector('#modalVideoContainer iframe');
    if (videoIframe) {
        videoIframe.src = videoIframe.src;
    }
    
    const audioPlayer = document.getElementById('modalAudioPlayer');
    if (audioPlayer) {
        audioPlayer.pause();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.btn-primary-kolaborasi, .small-btn-primary-kolaborasi');
    
    viewButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const card = this.closest('.content-card-kolaborasi, .small-card-kolaborasi');
            const title = card.querySelector('.card-title-kolaborasi, .small-card-title-kolaborasi').textContent;
            const description = card.querySelector('.card-description-kolaborasi, .small-card-description-kolaborasi').textContent;
            const badge = card.querySelector('.card-badge, .small-card-badge').textContent.trim();
            const badgeClass = card.querySelector('.card-badge, .small-card-badge').className;
            
            const stats = card.querySelectorAll('.stat-icons-kolaborasi span');
            const views = stats[0] ? stats[0].textContent.replace(/\D/g, '') : '0';
            const likes = stats[1] ? stats[1].textContent.replace(/\D/g, '') : '0';
            const comments = stats[2] ? stats[2].textContent.replace(/\D/g, '') : '0';
            
            const time = card.querySelector('.card-stats-kolaborasi > span, .small-card-stats-kolaborasi > span').textContent;
            
            const collabText = card.querySelector('.card-collaborators-kolaborasi, .small-card-meta-kolaborasi');
            let collaborators = [];
            if (collabText) {
                const text = collabText.textContent;
                if (text.includes('oleh')) {
                    collaborators = [text.replace('oleh', '').trim()];
                } else {
                    const names = text.split(/\s{2,}/).filter(name => {
                        const cleaned = name.trim().replace(/[^\w\s.-]/g, '');
                        return cleaned.length > 0;
                    });
                    collaborators = names.length > 0 ? names : ['Tidak ada kolaborator'];
                }
            }
            
            let contentType = 'video';
            let additionalData = {};
            
            if (badge.toLowerCase().includes('video')) {
                contentType = 'video';
                additionalData.videoUrl = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
            } else if (badge.toLowerCase().includes('musik')) {
                contentType = 'audio';
                additionalData.audioTitle = 'Gamelan Digital Fusion - 5:24';
            } else if (badge.toLowerCase().includes('puisi')) {
                contentType = 'text';
                additionalData.textContent = `Rindu Kampung

Di bawah langit senja kemerahan
Terdengar suara gamelan berdentang
Mengingatkan masa kecil yang indah
Di kampung halaman penuh kenangan

Sawah menguning terhampar luas
Angin sepoi menyapa dengan mesra
Sungai kecil mengalir tanpa lelah
Membawa cerita leluhur kita

Wahai kampung, betapa dirindukan
Hidup sederhana namun penuh makna
Kekeluargaan yang takkan tergantikan
Warisan budaya yang harus dijaga`;
            } else if (badge.toLowerCase().includes('foto')) {
                contentType = 'gallery';
                additionalData.galleryItems = [
                    { title: 'Foto Nelayan 1' },
                    { title: 'Foto Nelayan 2' },
                    { title: 'Foto Nelayan 3' },
                    { title: 'Foto Nelayan 4' }
                ];
            } else if (badge.toLowerCase().includes('kerajinan')) {
                contentType = 'craft';
                additionalData.craftTitle = title;
            }
            
            openModal({
                title: title,
                description: description,
                badge: badge,
                badgeClass: badgeClass,
                views: views,
                likes: likes,
                comments: comments,
                time: time,
                collaborators: collaborators,
                contentType: contentType,
                ...additionalData
            });
        });
    });
    
    document.getElementById('modalKarya').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
});

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
    
    const uploadBtn = document.querySelector('.upload-btn');
    if (uploadBtn) {
        uploadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openUploadModal();
        });
    }
    
    const ctaUploadBtn = document.querySelector('.cta-btn-primary-kolaborasi');
    if (ctaUploadBtn) {
        ctaUploadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openUploadModal();
        });
    }
    
    document.getElementById('modalUpload').addEventListener('click', function(e) {
        if (e.target === this) {
            closeUploadModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('modalUpload');
            if (modal.classList.contains('active')) {
                closeUploadModal();
            }
        }
    });
    
    const uploadForm = document.getElementById('uploadForm');
    if (uploadForm) {
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Karya berhasil diupload! (Demo)');
            closeUploadModal();
        });
    }
});
</script>