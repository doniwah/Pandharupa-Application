<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forum Komunitas Budaya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #FAF8F5;
            line-height: 1.5;
        }

        /* Header Styles */
        .header {
            padding: 48px 16px;
            justify-content: center;
        }

        .header-content {
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
            justify-content: center;
        }

        .header-title {
            font-size: 44px;
            font-weight: bold;
            color: #EC8F4D;
            margin-bottom: 12px;
        }

        .header-description {
            color: #4b5563;
            font-size: 18px;
            position: center;
        }

        .stats-container {
            max-width: 1152px;
            margin: -32px auto 32px;
            padding: 0 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        @media (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 24px;
            text-align: center;
        }

        .stat-icon {
            color: #f97316;
            font-size: 1.875rem;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Main Content */
        .main-container {
            max-width: 1152px;
            margin: 0 auto;
            padding: 0 16px 48px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        @media (min-width: 1024px) {
            .content-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* Search and Button */
        .search-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 24px;
        }

        @media (min-width: 640px) {
            .search-container {
                flex-direction: row;
            }
        }

        .search-wrapper {
            flex: 1;
            position: relative;
        }

        .element-search {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 12px;
            color: #9ca3af;
        }

        .search-input {
            width: 100%;
            padding: 8px 16px 8px 40px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            outline: none;
        }

        .search-input:focus {
            ring: 2px;
            ring-color: #f97316;
        }

        .btn-new-topic {
            background-color: #f97316;
            color: white;
            padding: 8px 24px;
            border-radius: 4px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-new-topic:hover {
            background-color: #ea580c;
        }

        /* Avatar */
        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 0;
        }

        /* Badge */
        .badge-featured {
            background-color: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        /* Post Card */
        .post-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 24px;
            transition: all 0.3s ease;
        }

        .post-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .post-content {
            display: flex;
            gap: 16px;
        }

        .post-body {
            flex: 1;
        }

        .post-body a {
            text-decoration: none;
        }

        .post-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .category-badge {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .post-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            cursor: pointer;
            text-decoration: none;
        }

        .post-title:hover {
            color: #ea580c;
        }

        .post-excerpt {
            color: #4b5563;
            font-size: 0.875rem;
            margin-bottom: 12px;
        }

        .post-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .post-footer {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .replies-count {
            color: #4b5563;
        }

        .replies-count a {
            color: #4b5563;
        }

        .replies-count a:hover {
            color: #f6a104;
        }

        .like-btn {
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .like-btn.text-red-500 {
            color: #ef4444;
        }

        .like-btn.text-gray-400 {
            color: #9ca3af;
        }

        .like-btn:disabled {
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-state {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 48px;
            text-align: center;
        }

        .empty-icon {
            color: #d1d5db;
            font-size: 4rem;
            margin-bottom: 16px;
        }

        .empty-text {
            color: #6b7280;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .sidebar-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 24px;
        }

        .sidebar-title {
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .sidebar-description {
            font-size: 0.875rem;
            color: #4b5563;
            margin-bottom: 16px;
        }

        .btn-all-categories {
            display: block;
            width: 100%;
            background-color: #f97316;
            color: white;
            padding: 8px;
            border-radius: 8px;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            margin-bottom: 16px;
        }

        .btn-all-categories:hover {
            background-color: #ea580c;
        }

        .category-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #374151;
        }

        .category-item:hover {
            background-color: #f9fafb;
        }

        .category-item.active {
            background-color: #fff7ed;
        }

        .category-count {
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* Active Users */
        .user-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .user-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(to bottom right, #f97316, #ea580c);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.875rem;
        }

        .user-name {
            color: #374151;
        }

        /* Forum Rules */
        .rules-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .rule-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .rule-icon {
            color: #10b981;
            margin-top: 4px;
        }

        .rule-text {
            font-size: 0.875rem;
            color: #4b5563;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 12px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 32px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ea580c;
        }

        .btn-close {
            color: #6b7280;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        .btn-close:hover {
            color: #374151;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            color: #374151;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
        }

        .form-control:focus {
            ring: 2px;
            ring-color: #f97316;
        }

        .form-textarea {
            width: 100%;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            resize: vertical;
        }

        .form-textarea:focus {
            ring: 2px;
            ring-color: #f97316;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .btn-cancel {
            padding: 8px 24px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: white;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background-color: #f9fafb;
        }

        .btn-submit {
            padding: 8px 24px;
            background-color: #f97316;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #ea580c;
        }

        /* Pagination */
        .pagination {
            margin-top: 24px;
        }

        /* Animation */
        @keyframes bounce {

            0%,
            100% {
                transform: scale(1);
            }

            25% {
                transform: scale(1.3);
            }

            50% {
                transform: scale(0.9);
            }

            75% {
                transform: scale(1.1);
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
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
