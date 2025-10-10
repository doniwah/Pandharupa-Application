<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forum Komunitas Budaya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css') }}/navbar.css">
    <link rel="stylesheet" href="{{ asset('css/pages') }}/forum.css">
</head>

<body>
    @include('components.navbar')

    <div class="header">
        <div class="header-content">
            <h1 class="header-title">Forum Komunitas Budaya</h1>
            <p class="header-description">Bergabunglah dalam diskusi, berbagi pengetahuan, dan terhubung dengan sesama
                pecinta budaya Pendalungan</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-users stat-icon"></i>
                <div class="stat-value">{{ number_format($stats['total_members']) }}</div>
                <div class="stat-label">Total Member</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-comments stat-icon"></i>
                <div class="stat-value">{{ $stats['active_discussions'] }}</div>
                <div class="stat-label">Diskusi Aktif</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-calendar-day stat-icon"></i>
                <div class="stat-value">{{ $stats['posts_today'] }}</div>
                <div class="stat-label">Post Hari Ini</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-chart-line stat-icon"></i>
                <div class="stat-value">{{ $stats['users_online'] }}</div>
                <div class="stat-label">User Online</div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="content-grid">
            <div class="left-column">
                <div class="search-container">
                    <form method="GET" action="{{ route('forum.index') }}" class="search-wrapper">
                        <div class="element-search">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari diskusi..." class="search-input">
                        </div>
                    </form>
                    <button onclick="openModal()" class="btn-new-topic">
                        <i class="fas fa-plus"></i> Topik Baru
                    </button>
                </div>
                @forelse($topics as $topic)
                    <div class="post-card">
                        <div class="post-content">
                            <div class="avatar">
                                {{ strtoupper(substr($topic->user->name, 0, 2)) }}
                            </div>
                            <div class="post-body">
                                <div class="post-header">
                                    @if ($topic->isAnsweredFor(auth()->user()))
                                        <span class="badge-featured">Terjawab</span>
                                    @endif
                                    <span class="category-badge">{{ $topic->category->name }}</span>
                                </div>
                                <h3 class="post-title">
                                    {{ $topic->title }}
                                </h3>
                                <p class="post-excerpt">
                                    {{ Str::limit($topic->content, 150) }}
                                </p>
                                <div class="post-meta">
                                    <span>oleh {{ $topic->user->name }}</span>
                                    <span><i class="far fa-clock"></i> {{ $topic->created_at->diffForHumans() }}</span>
                                    <span><i class="far fa-eye"></i> {{ $topic->views }}</span>
                                </div>
                                <div class="post-footer">
                                    <span class="replies-count">
                                        <a href="{{ route('forum.show', $topic->id) }}">
                                            <i class="far fa-comment"></i> {{ $topic->replies->count() }} balasan</a>
                                    </span>
                                    <button onclick="toggleLike(event, {{ $topic->id }})"
                                        class="like-btn {{ $topic->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400' }}"
                                        data-topic-id="{{ $topic->id }}"
                                        {{ $topic->isLikedBy(auth()->user()) ? 'disabled' : '' }}>
                                        <i
                                            class="{{ $topic->isLikedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart"></i>
                                        <span class="likes-count">{{ $topic->likes->count() }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-inbox empty-icon"></i>
                        <p class="empty-text">Belum ada topik diskusi</p>
                    </div>
                @endforelse
                <div class="pagination">
                    {{ $topics->links() }}
                </div>
            </div>
            <div class="sidebar">
                <!-- Categories -->
                <div class="sidebar-card">
                    <h3 class="sidebar-title">Kategori</h3>
                    <p class="sidebar-description">Jelajahi topik berdasarkan kategori</p>
                    <a href="{{ route('forum.index') }}" class="btn-all-categories">
                        Semua Kategori
                    </a>
                    <div class="category-list">
                        @foreach ($categories as $category)
                            <a href="{{ route('forum.index', ['category' => $category->id]) }}"
                                class="category-item {{ request('category') == $category->id ? 'active' : '' }}">
                                <span>{{ $category->name }}</span>
                                <span class="category-count">{{ $category->topics_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-card">
                    <h3 class="sidebar-title">Pengguna Aktif</h3>
                    <p class="sidebar-description">Member yang sedang online</p>
                    <div class="user-list">
                        @foreach ($activeUsers as $user)
                            <div class="user-item">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="user-name">{{ $user->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-card">
                    <h3 class="sidebar-title">Aturan Forum</h3>
                    <div class="rules-list">
                        <div class="rule-item">
                            <span class="rule-icon"><i class="fas fa-check"></i></span>
                            <span class="rule-text">Gunakan bahasa yang sopan dan santun</span>
                        </div>
                        <div class="rule-item">
                            <span class="rule-icon"><i class="fas fa-check"></i></span>
                            <span class="rule-text">Fokus pada topik budaya Pendalungan</span>
                        </div>
                        <div class="rule-item">
                            <span class="rule-icon"><i class="fas fa-check"></i></span>
                            <span class="rule-text">Hindari spam dan konten tidak relevan</span>
                        </div>
                        <div class="rule-item">
                            <span class="rule-icon"><i class="fas fa-check"></i></span>
                            <span class="rule-text">Hormati pendapat pengguna lain</span>
                        </div>
                        <div class="rule-item">
                            <span class="rule-icon"><i class="fas fa-check"></i></span>
                            <span class="rule-text">Bagikan informasi yang akurat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="createTopicModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Buat Topik Diskusi Baru</h2>
                <button onclick="closeModal()" class="btn-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('forum.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" required class="form-control">
                        <option value="">Pilih kategori diskusi</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Topik</label>
                    <input type="text" name="title" required placeholder="Masukkan judul topik diskusi..."
                        class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Isi Diskusi</label>
                    <textarea name="content" rows="6" required placeholder="Tulis detail topik yang ingin didiskusikan..."
                        class="form-textarea"></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" onclick="closeModal()" class="btn-cancel">
                        Batal
                    </button>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Publikasikan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('createTopicModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('createTopicModal').classList.remove('active');
        }


        window.onclick = function(event) {
            const modal = document.getElementById('createTopicModal');
            if (event.target == modal) {
                closeModal();
            }
        }


        function toggleLike(event, topicId) {
            event.preventDefault();

            const btn = document.querySelector(`button[data-topic-id="${topicId}"]`);
            const heartIcon = btn.querySelector('i.fa-heart');
            const likesCount = btn.querySelector('.likes-count');


            btn.style.transform = 'scale(1.2)';
            setTimeout(() => {
                btn.style.transform = 'scale(1)';
            }, 200);

            fetch(`/forum/${topicId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        likesCount.textContent = data.likes_count;

                        if (data.liked) {

                            btn.classList.remove('text-gray-400');
                            btn.classList.add('text-red-500');
                            heartIcon.classList.remove('far');
                            heartIcon.classList.add('fas');

                            // Animasi bounce
                            heartIcon.style.animation = 'bounce 0.5s ease';
                            setTimeout(() => {
                                heartIcon.style.animation = '';
                            }, 500);
                        } else {

                            btn.classList.remove('text-red-500');
                            btn.classList.add('text-gray-400');
                            heartIcon.classList.remove('fas');
                            heartIcon.classList.add('far');
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>
