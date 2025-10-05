<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $topic->title }} - Forum Komunitas Budaya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f9fafb;
            line-height: 1.5;
        }

        /* Header */
        .header {
            background: linear-gradient(to right, #fff7ed, #ffedd5);
            padding: 32px 16px;
        }

        .header-content {
            max-width: 1152px;
            margin: 0 auto;
        }

        .back-link {
            color: #ea580c;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 16px;
        }

        .back-link:hover {
            color: #c2410c;
        }

        /* Main Container */
        .main-container {
            max-width: 1152px;
            margin: 0 auto;
            padding: 32px 16px;
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

        /* Card */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 24px;
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

        /* Topic Card */
        .topic-header {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }

        .topic-info {
            flex: 1;
        }

        .topic-badges {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .category-badge {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .topic-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .topic-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 16px;
        }

        /* Content */
        .topic-content {
            max-width: none;
            margin-bottom: 16px;
        }

        .topic-text {
            color: #374151;
            line-height: 1.75;
            white-space: pre-wrap;
        }

        /* Footer Actions */
        .topic-footer {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        .replies-count {
            color: #4b5563;
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

        /* Replies Section */
        .replies-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .reply-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
        }

        .reply-item:not(:last-child) {
            border-bottom: 1px solid #e5e7eb;
        }

.reply-body {
            flex: 1;
            min-width: 0;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }

        .reply-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .reply-author {
            font-weight: 600;
            color: #1f2937;
        }

        .reply-time {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .reply-text {
            color: #374151;
            line-height: 1.75;
            white-space: pre-wrap;
            max-width: 800px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 32px 0;
        }

        .empty-icon {
            color: #d1d5db;
            font-size: 3rem;
            margin-bottom: 12px;
        }

        .empty-text {
            color: #6b7280;
        }

        /* Reply Form */
        .form-title {
            font-size: 1.125rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-textarea {
            width: 100%;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            resize: vertical;
            font-family: inherit;
        }

        .form-textarea:focus {
            ring: 2px;
            ring-color: #f97316;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
        }

        .btn-submit {
            padding: 8px 24px;
            background-color: #f97316;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-submit:hover {
            background-color: #ea580c;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 24px;
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

        /* Stats */
        .stats-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            color: #4b5563;
        }

        .stat-value {
            font-weight: 600;
            color: #1f2937;
        }

        /* Categories */
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

        .category-count {
            color: #6b7280;
            font-size: 0.875rem;
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

        /* Animation */
        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.3); }
            50% { transform: scale(0.9); }
            75% { transform: scale(1.1); }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <a href="{{ route('forum.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Forum
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="content-grid">
            <!-- Left Column - Topic & Replies -->
            <div class="left-column">
                <!-- Topic Card -->
                <div class="card">
                    <div class="topic-header">
                        <div class="avatar">
                            {{ strtoupper(substr($topic->user->name, 0, 2)) }}
                        </div>
                        <div class="topic-info">
                            <div class="topic-badges">
                                @if ($topic->isAnsweredFor(auth()->user()))
                                    <span class="badge-featured">Terjawab</span>
                                @endif
                                <span class="category-badge">{{ $topic->category->name }}</span>
                            </div>
                            <h1 class="topic-title">
                                {{ $topic->title }}
                            </h1>
                            <div class="topic-meta">
                                <span>oleh {{ $topic->user->name }}</span>
                                <span><i class="far fa-clock"></i> {{ $topic->created_at->diffForHumans() }}</span>
                                <span><i class="far fa-eye"></i> {{ $topic->views }} views</span>
                            </div>
                        </div>
                    </div>

                    <div class="topic-content">
                        <p class="topic-text">{{ $topic->content }}</p>
                    </div>

                    <div class="topic-footer">
                        <span class="replies-count">
                            <i class="far fa-comment"></i> {{ $topic->replies->count() }} balasan
                        </span>
                        <button onclick="toggleLike(event, {{ $topic->id }})"
                            class="like-btn {{ $topic->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400' }}"
                            data-topic-id="{{ $topic->id }}"
                            {{ $topic->isLikedBy(auth()->user()) ? 'disabled' : '' }}>
                            <i class="{{ $topic->isLikedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart"></i>
                            <span class="likes-count">{{ $topic->likes->count() }}</span>
                        </button>
                    </div>
                </div>

                <!-- Replies Section -->
                <div class="card">
                    <h2 class="replies-title">
                        <i class="far fa-comments"></i> Balasan ({{ $topic->replies->count() }})
                    </h2>

                    @forelse($topic->replies as $reply)
                        <div class="reply-item">
                            <div class="avatar">
                                {{ strtoupper(substr($reply->user->name, 0, 2)) }}
                            </div>
                            <div class="reply-body">
                                <div class="reply-header">
                                    <span class="reply-author">{{ $reply->user->name }}</span>
                                    <span class="reply-time">{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="reply-text">{{ $reply->content }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="far fa-comment-dots empty-icon"></i>
                            <p class="empty-text">Belum ada balasan. Jadilah yang pertama!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Reply Form -->
                <div class="card">
                    <h3 class="form-title">Tulis Balasan</h3>
                    <form method="POST" action="{{ route('forum.reply', $topic->id) }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" rows="4" required placeholder="Tulis balasan Anda..."
                                class="form-textarea"></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane"></i> Kirim Balasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="sidebar">
                <!-- Topic Stats -->
                <div class="card">
                    <h3 class="sidebar-title">Statistik Topik</h3>
                    <div class="stats-list">
                        <div class="stat-item">
                            <span class="stat-label"><i class="far fa-eye"></i> Views</span>
                            <span class="stat-value">{{ $topic->views }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label"><i class="far fa-comment"></i> Balasan</span>
                            <span class="stat-value">{{ $topic->replies->count() }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label"><i class="fas fa-heart"></i> Likes</span>
                            <span class="stat-value">{{ $topic->likes->count() }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label"><i class="far fa-clock"></i> Dibuat</span>
                            <span class="stat-value">{{ $topic->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="card">
                    <h3 class="sidebar-title">Kategori</h3>
                    <p class="sidebar-description">Jelajahi topik berdasarkan kategori</p>
                    <a href="{{ route('forum.index') }}" class="btn-all-categories">
                        Semua Kategori
                    </a>
                    <div class="category-list">
                        @foreach ($categories as $category)
                            <a href="{{ route('forum.index', ['category' => $category->id]) }}" class="category-item">
                                <span>{{ $category->name }}</span>
                                <span class="category-count">{{ $category->topics_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Forum Rules -->
                <div class="card">
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

    <script>
        // Like toggle function (Instagram style)
        function toggleLike(event, topicId) {
            event.preventDefault();

            const btn = document.querySelector(`button[data-topic-id="${topicId}"]`);
            const heartIcon = btn.querySelector('i.fa-heart');
            const likesCount = btn.querySelector('.likes-count');

            // Animasi scale saat diklik
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
                            // Liked - warna merah dan solid
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
                            // Unliked - warna abu-abu dan outline
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
