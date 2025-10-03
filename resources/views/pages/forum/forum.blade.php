<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forum Komunitas Budaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        }

        .badge-featured {
            background-color: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .post-card {
            transition: all 0.3s ease;
        }

        .post-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

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
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-50 to-orange-100 py-12 px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-3xl font-bold text-orange-600 mb-3">Forum Komunitas Budaya</h1>
            <p class="text-gray-600">Bergabunglah dalam diskusi, berbagi pengetahuan, dan terhubung dengan sesama
                pecinta budaya Pendalungan</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="max-w-6xl mx-auto px-4 -mt-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <i class="fas fa-users text-orange-500 text-3xl mb-2"></i>
                <div class="text-2xl font-bold text-gray-800">{{ number_format($stats['total_members']) }}</div>
                <div class="text-sm text-gray-500">Total Member</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <i class="fas fa-comments text-orange-500 text-3xl mb-2"></i>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['active_discussions'] }}</div>
                <div class="text-sm text-gray-500">Diskusi Aktif</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <i class="fas fa-calendar-day text-orange-500 text-3xl mb-2"></i>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['posts_today'] }}</div>
                <div class="text-sm text-gray-500">Post Hari Ini</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <i class="fas fa-chart-line text-orange-500 text-3xl mb-2"></i>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['users_online'] }}</div>
                <div class="text-sm text-gray-500">User Online</div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Posts -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Search and New Topic -->
                <div class="flex flex-col sm:flex-row gap-3 mb-6">
                    <form method="GET" action="{{ route('forum.index') }}" class="flex-1">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari diskusi..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                    </form>
                    <button onclick="openModal()"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium">
                        <i class="fas fa-plus mr-2"></i>Topik Baru
                    </button>
                </div>

                <!-- Topics List -->
                @forelse($topics as $topic)
                    <div class="bg-white rounded-lg shadow p-6 post-card">
                        <div class="flex gap-4">
                            <div class="avatar flex-shrink-0">
                                {{ strtoupper(substr($topic->user->name, 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    @if ($topic->isAnsweredFor(auth()->user()))
                                        <span class="badge-featured">Terjawab</span>
                                    @endif
                                    <span class="text-sm text-gray-600">{{ $topic->category->name }}</span>
                                </div>
                                <a href="{{ route('forum.show', $topic->id) }}">
                                    <h3
                                        class="text-lg font-semibold text-gray-800 mb-2 hover:text-orange-600 cursor-pointer">
                                        {{ $topic->title }}
                                    </h3>
                                </a>
                                <p class="text-gray-600 text-sm mb-3">
                                    {{ Str::limit($topic->content, 150) }}
                                </p>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-3">
                                    <span>oleh {{ $topic->user->name }}</span>
                                    <span><i
                                            class="far fa-clock mr-1"></i>{{ $topic->created_at->diffForHumans() }}</span>
                                    <span><i class="far fa-eye mr-1"></i>{{ $topic->views }}</span>
                                </div>
                                <div class="flex items-center gap-4 pt-3 border-t">
                                    <span class="text-gray-600">
                                        <i class="far fa-comment mr-1"></i>{{ $topic->replies->count() }} balasan
                                    </span>
                                    <button onclick="toggleLike(event, {{ $topic->id }})"
                                        class="like-btn {{ $topic->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400' }} transition-all duration-200"
                                        data-topic-id="{{ $topic->id }}"
                                        {{ $topic->isLikedBy(auth()->user()) ? 'disabled' : '' }}>
                                        <i
                                            class="{{ $topic->isLikedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart mr-1"></i>
                                        <span class="likes-count">{{ $topic->likes->count() }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow p-12 text-center">
                        <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500">Belum ada topik diskusi</p>
                    </div>
                @endforelse

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $topics->links() }}
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Categories -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Kategori</h3>
                    <p class="text-sm text-gray-600 mb-4">Jelajahi topik berdasarkan kategori</p>
                    <a href="{{ route('forum.index') }}"
                        class="block w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-medium mb-4 text-center">
                        Semua Kategori
                    </a>
                    <div class="space-y-2">
                        @foreach ($categories as $category)
                            <a href="{{ route('forum.index', ['category' => $category->id]) }}"
                                class="flex justify-between items-center py-2 hover:bg-gray-50 px-2 rounded cursor-pointer {{ request('category') == $category->id ? 'bg-orange-50' : '' }}">
                                <span class="text-gray-700">{{ $category->name }}</span>
                                <span class="text-gray-500 text-sm">{{ $category->topics_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Active Users -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Pengguna Aktif</h3>
                    <p class="text-sm text-gray-600 mb-4">Member yang sedang online</p>
                    <div class="space-y-3">
                        @foreach ($activeUsers as $user)
                            <div class="flex items-center gap-3">
                                <div style="width: 40px; height: 40px;"
                                    class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="text-gray-700">{{ $user->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Forum Rules -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Aturan Forum</h3>
                    <div class="space-y-2">
                        <div class="flex items-start gap-2">
                            <span class="text-green-500 mt-1"><i class="fas fa-check"></i></span>
                            <span class="text-sm text-gray-600">Gunakan bahasa yang sopan dan santun</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-green-500 mt-1"><i class="fas fa-check"></i></span>
                            <span class="text-sm text-gray-600">Fokus pada topik budaya Pendalungan</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-green-500 mt-1"><i class="fas fa-check"></i></span>
                            <span class="text-sm text-gray-600">Hindari spam dan konten tidak relevan</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-green-500 mt-1"><i class="fas fa-check"></i></span>
                            <span class="text-sm text-gray-600">Hormati pendapat pengguna lain</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-green-500 mt-1"><i class="fas fa-check"></i></span>
                            <span class="text-sm text-gray-600">Bagikan informasi yang akurat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Topic -->
    <div id="createTopicModal" class="modal">
        <div class="modal-content p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-orange-600">Buat Topik Diskusi Baru</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('forum.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                    <select name="category_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">Pilih kategori diskusi</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul Topik</label>
                    <input type="text" name="title" required placeholder="Masukkan judul topik diskusi..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Isi Diskusi</label>
                    <textarea name="content" rows="6" required placeholder="Tulis detail topik yang ingin didiskusikan..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>

                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg">
                        <i class="fas fa-paper-plane mr-2"></i>Publikasikan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functions
        function openModal() {
            document.getElementById('createTopicModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('createTopicModal').classList.remove('active');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('createTopicModal');
            if (event.target == modal) {
                closeModal();
            }
        }

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
                            btn.classList.remove('text-gray-600');
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
                            btn.classList.add('text-gray-600');
                            heartIcon.classList.remove('fas');
                            heartIcon.classList.add('far');
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // CSS untuk animasi bounce
        const style = document.createElement('style');
        style.textContent = `
            @keyframes bounce {
                0%, 100% { transform: scale(1); }
                25% { transform: scale(1.3); }
                50% { transform: scale(0.9); }
                75% { transform: scale(1.1); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
