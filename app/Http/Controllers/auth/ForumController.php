<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        // Update last activity untuk user yang login
        if (Auth::check()) {
            Cache::put('user-online-' . Auth::id(), true, now()->addMinutes(5));
        }

        $query = Topic::with(['user', 'category', 'replies', 'likes'])
            ->orderBy('created_at', 'desc');

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $topics = $query->paginate(10);
        $categories = Category::withCount('topics')->get();

        // Hitung user yang benar-benar online
        $onlineUsers = $this->getOnlineUsers();

        // Statistics
        $stats = [
            'total_members' => User::count(),
            'active_discussions' => Topic::count(),
            'posts_today' => Topic::whereDate('created_at', today())->count(),
            'users_online' => count($onlineUsers),
        ];

        // Active users (yang benar-benar online)
        $activeUsers = User::whereIn('id', $onlineUsers)->take(4)->get();

        return view('pages.forum.forum', compact('topics', 'categories', 'stats', 'activeUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $topic = Topic::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.show', $topic->id)
            ->with('success', 'Topik berhasil dibuat!');
    }

    public function show($id)
    {
        // Update last activity untuk user yang login
        if (Auth::check()) {
            Cache::put('user-online-' . Auth::id(), true, now()->addMinutes(5));
        }

        $topic = Topic::with(['user', 'category', 'replies.user', 'likes'])
            ->findOrFail($id);

        $topic->incrementViews();

        $categories = Category::withCount('topics')->get();

        return view('pages.forum.show', compact('topic', 'categories'));
    }

    public function storeReply(Request $request, $topicId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $topic = Topic::findOrFail($topicId);
        $user = Auth::user();

        Reply::create([
            'topic_id' => $topic->id,
            'user_id' => $user->id,
            'content' => $request->content,
        ]);

        // Mark topic as answered untuk user yang membalas
        $topic->markAsAnsweredFor($user);

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }

    public function toggleLike($topicId)
    {
        $topic = Topic::findOrFail($topicId);
        $user = Auth::user();

        // Cek apakah sudah pernah like
        $alreadyLiked = $topic->isLikedBy($user);

        if (!$alreadyLiked) {
            // Hanya bisa like, tidak bisa unlike
            $topic->likes()->create(['user_id' => $user->id]);
            $liked = true;
        } else {
            // Sudah like, return status yang sama
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $topic->likes()->count(),
            'already_liked' => $alreadyLiked,
        ]);
    }

    // Helper function untuk get online users
    private function getOnlineUsers()
    {
        $users = User::all();
        $onlineUsers = [];

        foreach ($users as $user) {
            if (Cache::has('user-online-' . $user->id)) {
                $onlineUsers[] = $user->id;
            }
        }

        return $onlineUsers;
    }
}