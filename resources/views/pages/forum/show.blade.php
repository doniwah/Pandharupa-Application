<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $topic->title }} - Forum Komunitas Budaya</title>
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
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-50 to-orange-100 py-8 px-4">
        <div class="max-w-6xl mx-auto">
            <a href="{{ route('forum.index') }}" class="text-orange-600 hover:text-orange-700 mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Forum
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Topic & Replies -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Topic Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex gap-4 mb-4">
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
                            <h1 class="text-2xl font-bold text-gray-800 mb-3">
                                {{ $topic->title }}
                            </h1>
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-4">
                                <span>oleh {{ $topic->user->name }}</span>
                                <span><i class="far fa-clock mr-1"></i>{{ $topic->created_at->diffForHumans() }}</span>
                                <span><i class="far fa-eye mr-1"></i>{{ $topic->views }} views</span>
                            </div>
                        </div>
                    </div>

                    <div class="prose max-w-none mb-4">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $topic->content }}</p>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t">
                        <span class="text-gray-600">
                            <i class="far fa-comment mr-1"></i>{{ $topic->replies->count() }} balasan
                        </span>
                        <button onclick="toggleLike(event, {{ $topic->id }})"
                            class="like-btn {{ $topic->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400' }} transition-all duration-200"
                            data-topic-id="{{ $topic->id }}"
                            {{ $topic->isLikedBy(auth()->user()) ? 'disabled' : '' }}>
                            <i class="{{ $topic->isLikedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart mr-1"></i>
                            <span class="likes-count">{{ $topic->likes->count() }}</span>
                        </button>
                    </div>
                </div>

                <!-- Replies Section -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        <i class="far fa-comments mr-2"></i>Balasan ({{ $topic->replies->count() }})
                    </h2>

                    @forelse($topic->replies as $reply)
                        <div class="flex gap-4 py-4 {{ !$loop->last ? 'border-b' : '' }}">
                            <div class="avatar flex-shrink-0">
                                {{ strtoupper(substr($reply->user->name, 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="font-semibold text-gray-800">{{ $reply->user->name }}</span>
                                    <span
                                        class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $reply->content }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="far fa-comment-dots text-gray-300 text-5xl mb-3"></i>
                            <p class="text-gray-500">Belum ada balasan. Jadilah yang pertama!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Reply Form -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tulis Balasan</h3>
                    <form method="POST" action="{{ route('forum.reply', $topic->id) }}">
                        @csrf
                        <div class="mb-4">
                            <textarea name="content" rows="4" required placeholder="Tulis balasan Anda..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg">
                                <i class="fas fa-paper-plane mr-2"></i>Kirim Balasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Topic Stats -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Statistik Topik</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600"><i class="far fa-eye mr-2"></i>Views</span>
                            <span class="font-semibold text-gray-800">{{ $topic->views }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600"><i class="far fa-comment mr-2"></i>Balasan</span>
                            <span class="font-semibold text-gray-800">{{ $topic->replies->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600"><i class="fas fa-heart mr-2"></i>Likes</span>
                            <span class="font-semibold text-gray-800">{{ $topic->likes->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600"><i class="far fa-clock mr-2"></i>Dibuat</span>
                            <span class="font-semibold text-gray-800">{{ $topic->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

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
                                class="flex justify-between items-center py-2 hover:bg-gray-50 px-2 rounded cursor-pointer">
                                <span class="text-gray-700">{{ $category->name }}</span>
                                <span class="text-gray-500 text-sm">{{ $category->topics_count }}</span>
                            </a>
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
