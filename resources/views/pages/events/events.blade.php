<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Event Hub Pendalungan</title>
    <link rel="stylesheet" href="{{ asset('css') }}/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages') }}/event.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    @include('components.navbar')
    <section class="hero">
        <h1>Event Hub Pendalungan</h1>
        <p>Temukan dan ikuti berbagai acara menarik untuk memperdalam pengetahuan budaya Pendalungan</p>
    </section>


    <div class="stats">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_events'] }}</div>
            <div class="stat-label">Event Bulan Ini</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ number_format($stats['total_peserta']) }}</div>
            <div class="stat-label">Total Peserta</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['events_mendatang'] }}</div>
            <div class="stat-label">Event Mendatang</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['kepuasan'] }}%</div>
            <div class="stat-label">Kepuasan Peserta</div>
        </div>
    </div>


    <div class="container">

        <div class="filter-tabs">
            <button class="tab {{ $kategori == 'Semua' ? 'active' : '' }}"
                onclick="filterEvents('Semua')">Semua</button>
            <button class="tab {{ $kategori == 'Workshop' ? 'active' : '' }}"
                onclick="filterEvents('Workshop')">Workshop</button>
            <button class="tab {{ $kategori == 'Festival' ? 'active' : '' }}"
                onclick="filterEvents('Festival')">Festival</button>
            <button class="tab {{ $kategori == 'Webinar' ? 'active' : '' }}"
                onclick="filterEvents('Webinar')">Webinar</button>
            <button class="tab {{ $kategori == 'Kompetisi' ? 'active' : '' }}"
                onclick="filterEvents('Kompetisi')">Kompetisi</button>
            <button class="tab {{ $kategori == 'Pertunjukan' ? 'active' : '' }}"
                onclick="filterEvents('Pertunjukan')">Pertunjukan</button>
        </div>


        <h2 class="section-title">Event Unggulan</h2>
        @if ($eventUnggulan->count() > 0)
            <div class="events-grid">
                @foreach ($eventUnggulan as $event)
                    <div class="event-card">
                        <div class="event-header">
                            <div class="event-icon">{{ $event->icon ?? '🎉' }}</div>
                            <div>
                                <span
                                    class="badge badge-{{ strtolower($event->kategori) }}">{{ $event->kategori }}</span>
                                @if ($event->rating > 0)
                                    <div class="rating">
                                        <i class="bi bi-star"></i> {{ $event->rating }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="event-title">{{ $event->nama_event }}</h3>
                        <p class="event-description">{{ Str::limit($event->deskripsi, 80) }}</p>
                        <div class="event-details">
                            <div class="detail-item">
                                <span class="detail-icon">📅</span>
                                <span>{{ $event->tanggal_format }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-icon">⏰</span>
                                <span>{{ $event->waktu_format }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-icon">📍</span>
                                <span>{{ Str::limit($event->lokasi, 25) }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-icon">👥</span>
                                <span>{{ $event->jumlah_pendaftar }}/{{ $event->kapasitas_peserta }} peserta</span>
                            </div>
                        </div>
                        <div class="event-footer">
                            <div class="event-price {{ $event->harga_ticket == 0 ? 'gratis' : '' }}">
                                {{ $event->harga_format }}
                            </div>
                            <button class="btn-primary" onclick="openRegisterModal({{ $event->id }})">Daftar
                                Sekarang</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📅</div>
                <p>Belum ada event unggulan saat ini</p>
            </div>
        @endif


        <h2 class="section-title">Event Mendatang</h2>
        @if ($eventMendatang->count() > 0)
            <div class="events-grid">
                @foreach ($eventMendatang as $event)
                    <div class="event-card">
                        <div class="event-header">
                            <div class="event-icon">{{ $event->icon ?? '🎉' }}</div>
                            <div>
                                <span
                                    class="badge badge-{{ strtolower($event->kategori) }}">{{ $event->kategori }}</span>
                                @if ($event->rating > 0)
                                    <div class="rating">
                                        <i class="bi bi-star"></i> {{ $event->rating }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="event-title">{{ $event->nama_event }}</h3>
                        <p class="event-description">{{ Str::limit($event->deskripsi, 80) }}</p>
                        <div class="event-details">
                            <div class="detail-item">
                                <span class="detail-icon">📅</span>
                                <span>{{ $event->tanggal_format }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-icon">⏰</span>
                                <span>{{ $event->waktu_format }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-icon">📍</span>
                                <span>{{ Str::limit($event->lokasi, 25) }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-icon">👥</span>
                                <span>{{ $event->jumlah_pendaftar }}/{{ $event->kapasitas_peserta }} peserta</span>
                            </div>
                        </div>
                        <div class="event-footer">
                            <div class="event-price {{ $event->harga_ticket == 0 ? 'gratis' : '' }}">
                                {{ $event->harga_format }}
                            </div>
                            <div class="btn-group">
                                <button class="btn-secondary" onclick="openDetailModal({{ $event->id }})">Lihat
                                    Detail</button>
                                <button class="btn-primary"
                                    onclick="openRegisterModal({{ $event->id }})">Daftar</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📅</div>
                <p>Tidak ada event mendatang untuk kategori ini</p>
            </div>
        @endif


        <div class="cta-section">
            <h2>Ajukan Event Anda</h2>
            <p>Punya event budaya yang ingin dibagikan? Ajukan event Anda dan jangkau lebih banyak peserta!</p>
            <button class="btn-secondary" style="background: white; color: #FF8C42; border: none;"
                onclick="openSubmitEventModal()">Ajukan Event Sekarang</button>
        </div>
    </div>


    <div id="registerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Daftar Event</h2>
                <button class="close-btn" onclick="closeModal('registerModal')">&times;</button>
            </div>
            <p class="modal-subtitle" id="registerModalSubtitle"></p>
            <div id="registerAlert"></div>
            <form id="registerForm" onsubmit="submitRegistration(event)">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" name="nama_lengkap" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" name="email" placeholder="nama@email.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon</label>
                    <input type="tel" class="form-input" name="no_telepon" placeholder="08123456789" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Asal Instansi/Organisasi</label>
                    <input type="text" class="form-input" name="asal_instansi" placeholder="Nama instansi">
                </div>
                <div class="event-footer">
                    <div class="event-price" id="registerModalPrice"></div>
                    <button type="submit" class="btn-primary">Konfirmasi Pendaftaran</button>
                </div>
            </form>
        </div>
    </div>


    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h2 class="modal-title" id="detailModalTitle"></h2>
                    <span class="badge" id="detailModalBadge"></span>
                </div>
                <button class="close-btn" onclick="closeModal('detailModal')">&times;</button>
            </div>
            <p class="modal-subtitle" id="detailModalDescription"></p>
            <div class="detail-grid">
                <div class="detail-box">
                    <span class="detail-box-icon">📅</span>
                    <div class="detail-box-content">
                        <h4>Tanggal</h4>
                        <p id="detailModalDate"></p>
                    </div>
                </div>
                <div class="detail-box">
                    <span class="detail-box-icon">⏰</span>
                    <div class="detail-box-content">
                        <h4>Waktu</h4>
                        <p id="detailModalTime"></p>
                    </div>
                </div>
                <div class="detail-box">
                    <span class="detail-box-icon">📍</span>
                    <div class="detail-box-content">
                        <h4>Lokasi</h4>
                        <p id="detailModalLocation"></p>
                    </div>
                </div>
                <div class="detail-box">
                    <span class="detail-box-icon">👥</span>
                    <div class="detail-box-content">
                        <h4>Kapasitas</h4>
                        <p id="detailModalCapacity"></p>
                    </div>
                </div>
            </div>
            <div class="detail-box" style="margin: 20px 0;">
                <span class="detail-box-icon">⭐</span>
                <div class="detail-box-content">
                    <h4>Rating</h4>
                    <p id="detailModalRating"></p>
                </div>
            </div>
            <div class="event-footer" style="border-top: 2px solid #eee; padding-top: 20px; margin-top: 20px;">
                <div class="event-price" id="detailModalPrice"></div>
                <button class="btn-primary" onclick="openRegisterFromDetail()">Daftar Sekarang</button>
            </div>
        </div>
    </div>


    <div id="submitEventModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <div class="modal-header">
                <h2 class="modal-title">Ajukan Event Baru</h2>
                <button class="close-btn" onclick="closeModal('submitEventModal')">&times;</button>
            </div>
            <p class="modal-subtitle">Isi formulir di bawah untuk mengajukan event budaya Anda</p>
            <div id="submitEventAlert"></div>
            <form id="submitEventForm" onsubmit="submitEvent(event)">
                <div class="form-group">
                    <label class="form-label">Nama Event</label>
                    <input type="text" class="form-input" name="nama_event"
                        placeholder="Contoh: Workshop Batik Modern" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select class="form-input" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Festival">Festival</option>
                        <option value="Webinar">Webinar</option>
                        <option value="Kompetisi">Kompetisi</option>
                        <option value="Pertunjukan">Pertunjukan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Event</label>
                    <textarea class="form-input" name="deskripsi" placeholder="Jelaskan detail event Anda..." required></textarea>
                </div>
                <div class="detail-grid">
                    <div class="form-group">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-input" name="tanggal_mulai" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Selesai (Opsional)</label>
                        <input type="date" class="form-input" name="tanggal_selesai">
                    </div>
                </div>
                <div class="detail-grid">
                    <div class="form-group">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-input" name="waktu_mulai" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-input" name="waktu_selesai" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-input" name="lokasi"
                        placeholder="Contoh: Gedung Kesenian Jakarta" required>
                </div>
                <div class="detail-grid">
                    <div class="form-group">
                        <label class="form-label">Kapasitas Peserta</label>
                        <input type="number" class="form-input" name="kapasitas_peserta" min="1"
                            placeholder="100" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga Tiket (Rp)</label>
                        <input type="number" class="form-input" name="harga_ticket" min="0" value="0"
                            placeholder="0 untuk gratis" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Penyelenggara</label>
                    <input type="text" class="form-input" name="nama_penyelenggara"
                        placeholder="Nama organisasi/individu" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Penyelenggara</label>
                    <input type="email" class="form-input" name="email_penyelenggara"
                        placeholder="email@example.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon</label>
                    <input type="tel" class="form-input" name="no_telepon" placeholder="08123456789" required>
                    <small style="color: #666; display: block; margin-top: 5px;">Nomor WhatsApp yang akan dihubungi
                        peserta</small>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Ajukan
                    Event</button>
            </form>
        </div>
    </div>

    <script>
        let currentEventId = null;


        console.log('Page loaded successfully');
        console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.content);


        function filterEvents(kategori) {
            window.location.href = `{{ route('events.index') }}?kategori=${kategori}`;
        }


        function openRegisterModal(eventId) {
            console.log('Opening register modal for event:', eventId);
            currentEventId = eventId;

            fetch(`/events/${eventId}`)
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    console.log('Event data:', data);
                    const event = data.event;
                    document.getElementById('registerModalSubtitle').textContent =
                        `Isi formulir di bawah untuk mendaftar ke ${event.nama_event}`;

                    const price = event.harga_ticket == 0 ? 'Gratis' :
                        'Rp ' + new Intl.NumberFormat('id-ID').format(event.harga_ticket);
                    document.getElementById('registerModalPrice').textContent = price;
                    document.getElementById('registerModalPrice').className =
                        event.harga_ticket == 0 ? 'event-price gratis' : 'event-price';

                    document.getElementById('registerAlert').innerHTML = '';
                    document.getElementById('registerForm').reset();
                    document.getElementById('registerModal').classList.add('active');
                })
                .catch(error => {
                    console.error('Error loading event:', error);
                    alert('Gagal memuat data event. Silakan refresh halaman dan coba lagi.');
                });
        }


        function openDetailModal(eventId) {
            console.log('Opening detail modal for event:', eventId);
            currentEventId = eventId;

            fetch(`/events/${eventId}`)
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    console.log('Event detail:', data);
                    const event = data.event;
                    const jumlahPendaftar = data.jumlah_pendaftar;

                    document.getElementById('detailModalTitle').innerHTML =
                        `${event.icon || '🎉'} ${event.nama_event}`;

                    const badge = document.getElementById('detailModalBadge');
                    badge.textContent = event.kategori;
                    badge.className = `badge badge-${event.kategori.toLowerCase()}`;

                    document.getElementById('detailModalDescription').textContent = event.deskripsi;

                    // Format tanggal
                    const startDate = new Date(event.tanggal_mulai);
                    const endDate = event.tanggal_selesai ? new Date(event.tanggal_selesai) : null;
                    let dateStr = startDate.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                    if (endDate && startDate.getTime() !== endDate.getTime()) {
                        dateStr = `${startDate.getDate()}-${endDate.getDate()} ${endDate.toLocaleDateString('id-ID', { 
                            month: 'long', year: 'numeric' 
                        })}`;
                    }
                    document.getElementById('detailModalDate').textContent = dateStr;


                    document.getElementById('detailModalTime').textContent =
                        `${event.waktu_mulai.substring(0, 5)} - ${event.waktu_selesai.substring(0, 5)} WIB`;

                    document.getElementById('detailModalLocation').textContent = event.lokasi;
                    document.getElementById('detailModalCapacity').textContent =
                        `${jumlahPendaftar}/${event.kapasitas_peserta} peserta`;
                    document.getElementById('detailModalRating').textContent =
                        `${event.rating} dari 5.0`;

                    const price = event.harga_ticket == 0 ? 'Gratis' :
                        'Rp ' + new Intl.NumberFormat('id-ID').format(event.harga_ticket);
                    document.getElementById('detailModalPrice').textContent = price;
                    document.getElementById('detailModalPrice').className =
                        event.harga_ticket == 0 ? 'event-price gratis' : 'event-price';

                    document.getElementById('detailModal').classList.add('active');
                })
                .catch(error => {
                    console.error('Error loading detail:', error);
                    alert('Gagal memuat detail event. Silakan refresh halaman dan coba lagi.');
                });
        }


        function openRegisterFromDetail() {
            closeModal('detailModal');
            setTimeout(() => openRegisterModal(currentEventId), 300);
        }


        function openSubmitEventModal() {
            console.log('Opening submit event modal');
            document.getElementById('submitEventAlert').innerHTML = '';
            document.getElementById('submitEventForm').reset();
            document.getElementById('submitEventModal').classList.add('active');
        }


        function closeModal(modalId) {
            console.log('Closing modal:', modalId);
            document.getElementById(modalId).classList.remove('active');
        }


        function submitRegistration(e) {
            e.preventDefault();
            console.log('Submitting registration for event:', currentEventId);

            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            console.log('Registration data:', data);

            fetch(`/events/${currentEventId}/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(res => {
                    console.log('Registration response status:', res.status);
                    return res.json();
                })
                .then(response => {
                    console.log('Registration response:', response);
                    if (response.success) {
                        // Redirect ke WhatsApp
                        window.open(response.whatsapp_url, '_blank');
                        closeModal('registerModal');
                        showAlert('Pendaftaran berhasil! Silakan lanjutkan konfirmasi via WhatsApp.', 'success');
                    } else {
                        document.getElementById('registerAlert').innerHTML =
                            `<div class="alert alert-error">${response.message}</div>`;
                    }
                })
                .catch(error => {
                    console.error('Registration error:', error);
                    document.getElementById('registerAlert').innerHTML =
                        `<div class="alert alert-error">Terjadi kesalahan: ${error.message}</div>`;
                });
        }


        function submitEvent(e) {
            e.preventDefault();
            console.log('Submitting new event');

            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            console.log('Event data:', data);


            if (data.tanggal_selesai && data.tanggal_selesai < data.tanggal_mulai) {
                document.getElementById('submitEventAlert').innerHTML =
                    `<div class="alert alert-error">Tanggal selesai tidak boleh lebih awal dari tanggal mulai</div>`;
                return;
            }

            fetch('/events', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(res => {
                    console.log('Submit event response status:', res.status);
                    if (!res.ok) {
                        return res.json().then(err => Promise.reject(err));
                    }
                    return res.json();
                })
                .then(response => {
                    console.log('Submit event response:', response);
                    if (response.success) {
                        closeModal('submitEventModal');
                        showAlert('Event berhasil diajukan! Menunggu persetujuan admin.', 'success');
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        document.getElementById('submitEventAlert').innerHTML =
                            `<div class="alert alert-error">${response.message}</div>`;
                    }
                })
                .catch(error => {
                    console.error('Submit event error:', error);
                    let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';

                    if (error.errors) {
                        errorMessage = '<ul style="margin: 0; padding-left: 20px;">';
                        for (let field in error.errors) {
                            errorMessage += `<li>${error.errors[field][0]}</li>`;
                        }
                        errorMessage += '</ul>';
                    } else if (error.message) {
                        errorMessage = error.message;
                    }

                    document.getElementById('submitEventAlert').innerHTML =
                        `<div class="alert alert-error">${errorMessage}</div>`;
                });
        }


        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.textContent = message;
            alertDiv.style.position = 'fixed';
            alertDiv.style.top = '20px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '9999';
            alertDiv.style.minWidth = '300px';
            alertDiv.style.animation = 'slideUp 0.3s';
            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.style.animation = 'fadeOut 0.3s';
                setTimeout(() => alertDiv.remove(), 300);
            }, 3000);
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }

        // Add fadeOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; }
                to { opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        console.log('All scripts loaded successfully');
    </script>
</body>

</html>
