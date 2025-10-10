<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\KaryaComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class KolaborasiController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'semua');

        // Ambil statistik
        $stats = [
            'total_karya' => Karya::count(),
            'active_collaborators' => DB::table('karya_collaborators')
                ->distinct('user_id')
                ->count(),
            'downloads_month' => Karya::whereMonth('created_at', now()->month)
                ->sum('downloads'),
            'total_likes' => Karya::sum('likes')
        ];

        // Ambil karya featured
        $featuredKaryas = Karya::with(['user', 'collaborators'])
            ->featured()
            ->latest()
            ->take(2)
            ->get();

        // Ambil semua karya dengan filter kategori
        $allKaryas = Karya::with(['user', 'collaborators'])
            ->category($category)
            ->latest()
            ->paginate(12);

        return view('pages.kolaborasi.kolaborasi', compact(
            'stats',
            'featuredKaryas',
            'allKaryas',
            'category'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:tari,musik,puisi,dokumenter,fotografi,kerajinan',
            'description' => 'required|string',
            'file' => 'required|file|max:102400', // max 100MB
            'collaborators' => 'nullable|array',
            'collaborators.*' => 'exists:users,id'
        ]);

        try {
            DB::beginTransaction();

            // Upload file
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('karya_files', $fileName, 'public');

            // Tentukan tipe file
            $fileType = $this->determineFileType($file->getMimeType());

            // Buat karya
            $karya = Karya::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'file_path' => $filePath,
                'file_type' => $fileType,
                'user_id' => Auth::id()
            ]);

            // Tambahkan kolaborator jika ada
            if (!empty($validated['collaborators'])) {
                $karya->collaborators()->attach($validated['collaborators']);
            }

            DB::commit();

            return redirect()->route('kolaborasi.index')
                ->with('success', 'Karya berhasil diupload!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Hapus file jika ada error
            if (isset($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return back()->with('error', 'Gagal mengupload karya: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $karya = Karya::with(['user', 'collaborators', 'comments.user'])
            ->findOrFail($id);

        // Increment views
        $karya->incrementViews();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $karya->id,
                'title' => $karya->title,
                'description' => $karya->description,
                'category' => $karya->category,
                'file_path' => Storage::url($karya->file_path),
                'file_type' => $karya->file_type,
                'views' => $karya->views,
                'likes' => $karya->likes,
                'downloads' => $karya->downloads,
                'created_at' => $karya->created_at->diffForHumans(),
                'user' => [
                    'name' => $karya->user->name,
                    'avatar' => $karya->user->avatar ?? '/default-avatar.png'
                ],
                'collaborators' => $karya->collaborators->map(function ($collab) {
                    return [
                        'id' => $collab->id,
                        'name' => $collab->name
                    ];
                }),
                'comments' => $karya->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'user_name' => $comment->user->name,
                        'comment' => $comment->comment,
                        'created_at' => $comment->created_at->diffForHumans()
                    ];
                }),
                'is_liked' => Auth::check() ? $karya->isLikedBy(Auth::user()) : false
            ]
        ]);
    }

    public function download($id)
    {
        $karya = Karya::findOrFail($id);

        // Increment download count
        $karya->incrementDownloads();

        $filePath = storage_path('app/public/' . $karya->file_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($filePath);
    }

    public function like($id)
    {
        $karya = Karya::findOrFail($id);
        $user = Auth::user();

        if ($karya->isLikedBy($user)) {
            // Unlike
            $karya->likedByUsers()->detach($user->id);
            $karya->decrement('likes');
            $liked = false;
        } else {
            // Like
            $karya->likedByUsers()->attach($user->id);
            $karya->increment('likes');
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $karya->likes
        ]);
    }

    public function comment(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        $karya = Karya::findOrFail($id);

        $comment = KaryaComment::create([
            'karya_id' => $karya->id,
            'user_id' => Auth::id(),
            'comment' => $validated['comment']
        ]);

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'user_name' => Auth::user()->name,
                'comment' => $comment->comment,
                'created_at' => $comment->created_at->diffForHumans()
            ]
        ]);
    }

    private function determineFileType($mimeType)
    {
        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        } elseif (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        } elseif (str_starts_with($mimeType, 'image/')) {
            return 'image';
        } else {
            return 'document';
        }
    }
}
