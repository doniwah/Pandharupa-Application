<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class KolaborasiController extends Controller
{
    public function index(Request $request, $category = 'semua')
    {
        // Stats
        $stats = [
            'total_karya' => Karya::count(),
            'active_collaborators' => User::whereHas('karyas')->count(),
            'downloads_month' => Karya::whereMonth('created_at', now()->month)->sum('downloads'),
            'total_likes' => Karya::sum('likes')
        ];

        // Karya Unggulan - hanya tampil di kategori "semua" dan sesuai kategori yang difilter
        $featuredKaryas = collect();
        if ($category === 'semua') {
            $featuredKaryas = Karya::with(['user', 'collaborators'])
                ->orderBy('views', 'desc')
                ->orderBy('likes', 'desc')
                ->orderBy('downloads', 'desc')
                ->take(2)
                ->get();
        } else {
            // Untuk kategori tertentu, tampilkan karya unggulan dari kategori tersebut
            $featuredKaryas = Karya::with(['user', 'collaborators'])
                ->where('category', $category)
                ->orderBy('views', 'desc')
                ->orderBy('likes', 'desc')
                ->orderBy('downloads', 'desc')
                ->take(2)
                ->get();
        }

        // Semua Karya dengan filter
        $allKaryasQuery = Karya::with(['user', 'collaborators']);

        if ($category !== 'semua') {
            $allKaryasQuery->where('category', $category);
        }

        $allKaryas = $allKaryasQuery->orderBy('created_at', 'desc')->paginate(15);

        // Debug: Cek apakah filter bekerja
        Log::info('Filter Category: ' . $category);
        Log::info('Total Karya Found: ' . $allKaryas->total());

        // Jika request AJAX
        if ($request->ajax()) {
            $html = $this->renderContent($featuredKaryas, $allKaryas, $category);

            return response()->json([
                'success' => true,
                'html' => $html,
                'category' => $category,
                'debug' => [
                    'featured_count' => $featuredKaryas->count(),
                    'all_count' => $allKaryas->count(),
                    'category' => $category
                ]
            ]);
        }

        return view('pages/kolaborasi.kolaborasi', compact(
            'stats',
            'featuredKaryas',
            'allKaryas',
            'category'
        ));
    }

    private function renderContent($featuredKaryas, $allKaryas, $category)
    {
        $html = '';

        // Karya Unggulan
        if ($category == 'semua' && $featuredKaryas->count() > 0) {
            $html .= '
            <div class="featured-section-kolaborasi">
                <h2 class="section-title-kolaborasi">Karya Unggulan</h2>
                <div class="content-grid-kolaborasi">';

            foreach ($featuredKaryas as $karya) {
                $html .= $this->renderFeaturedCard($karya);
            }

            $html .= '
                </div>
            </div>';
        }

        // Semua Karya
        $html .= '
        <div class="all-works-section-kolaborasi">
            <h2 class="section-title-kolaborasi">' .
            ($category == 'semua' ? 'Semua Karya' : 'Karya ' . ucfirst($category)) .
            '</h2>
            <div class="all-works-grid-kolaborasi">';

        if ($allKaryas->count() > 0) {
            foreach ($allKaryas as $karya) {
                $html .= $this->renderSmallCard($karya, $category, $featuredKaryas);
            }
        } else {
            $html .= '
                <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
                    <p>Belum ada karya dalam kategori ini.</p>
                </div>';
        }

        $html .= '
            </div>
        </div>';

        return $html;
    }

    private function renderFeaturedCard($karya)
    {
        $icon = $this->getFileTypeIcon($karya->file_type);
        $collaborators = $this->renderCollaborators($karya);

        return '
        <div class="content-card-kolaborasi featured-card" data-karya-id="' . $karya->id . '">
            <div class="card-content-kolaborasi">
                <div class="card-icon-kolaborasi">
                    <i class="bi ' . $icon . '"></i>
                </div>
                <div class="card-badge badge-' . $karya->category . '-kolaborasi">
                    ' . ucfirst($karya->category) . '
                </div>
                <h3 class="card-title-kolaborasi">' . e($karya->title) . '</h3>
                <p class="card-description-kolaborasi">' . e(Str::limit($karya->description, 80)) . '</p>
                <div class="card-collaborators-kolaborasi">
                    <span>
                        <i class="bi bi-person-fill"></i> ' . e($karya->user->name) . '
                        ' . $collaborators . '
                    </span>
                </div>
                <div class="card-stats-kolaborasi">
                    <div class="stat-icons-kolaborasi">
                        <span><i class="bi bi-eye-fill"></i> ' . number_format($karya->views) . '</span>
                        <span><i class="bi bi-hand-thumbs-up-fill"></i> ' . number_format($karya->likes) . '</span>
                        <span><i class="bi bi-download"></i> ' . number_format($karya->downloads) . '</span>
                    </div>
                    <span>' . $karya->created_at->diffForHumans() . '</span>
                </div>
                <div class="card-actions-kolaborasi">
                    <button class="btn btn-primary-kolaborasi" onclick="viewKarya(' . $karya->id . ')">
                        <i class="bi bi-eye-fill"></i> Lihat
                    </button>
                    <a href="' . route('kolaborasi.download', $karya->id) . '" class="btn btn-secondary-kolaborasi" style="text-decoration: none;">
                        <i class="bi bi-download"></i> Unduh
                    </a>
                </div>
            </div>
        </div>';
    }

    private function renderSmallCard($karya, $category, $featuredKaryas)
    {
        $icon = $this->getCategoryIcon($karya->category);
        $isFeatured = $category === 'semua' && $featuredKaryas->contains('id', $karya->id);
        $featuredBadge = $isFeatured ? '<div class="featured-badge-small"><i class="bi bi-star-fill"></i></div>' : '';

        return '
        <div class="small-card-kolaborasi" data-karya-id="' . $karya->id . '">
            <div class="small-card-content-kolaborasi">
                <div class="small-card-icon-kolaborasi">
                    <i class="bi ' . $icon . '"></i>
                </div>
                ' . $featuredBadge . '
                <div class="small-card-badge badge-' . $karya->category . '-kolaborasi">
                    ' . ucfirst($karya->category) . '
                </div>
                <h3 class="small-card-title-kolaborasi">' . e($karya->title) . '</h3>
                <p class="small-card-description-kolaborasi">' . e(Str::limit($karya->description, 100)) . '</p>
                <div class="small-card-meta-kolaborasi">
                    oleh ' . e($karya->user->name) . '
                    ' . ($karya->collaborators->count() > 0 ? '+' . $karya->collaborators->count() : '') . '
                </div>
                <div class="small-card-stats-kolaborasi">
                    <div class="stat-icons-kolaborasi">
                        <span><i class="bi bi-eye-fill"></i> ' . number_format($karya->views) . '</span>
                        <span><i class="bi bi-hand-thumbs-up-fill"></i> ' . number_format($karya->likes) . '</span>
                        <span><i class="bi bi-download"></i> ' . number_format($karya->downloads) . '</span>
                    </div>
                    <span>' . $karya->created_at->diffForHumans() . '</span>
                </div>
                <div class="small-card-actions-kolaborasi">
                    <button class="small-btn small-btn-primary-kolaborasi" onclick="viewKarya(' . $karya->id . ')">
                        Lihat
                    </button>
                    <a href="' . route('kolaborasi.download', $karya->id) . '" class="small-btn small-btn-secondary-kolaborasi">
                        <i class="bi bi-download"></i> Unduh
                    </a>
                </div>
            </div>
        </div>';
    }

    private function getFileTypeIcon($fileType)
    {
        return match ($fileType) {
            'video' => 'bi-boombox',
            'audio' => 'bi-music-note-beamed',
            'image', 'pictures' => 'bi-camera-fill',
            default => 'bi-file-earmark-text-fill'
        };
    }

    private function getCategoryIcon($category)
    {
        return match ($category) {
            'tari' => 'bi-boombox',
            'musik' => 'bi-music-note-beamed',
            'puisi' => 'bi-file-text-fill',
            'dokumenter' => 'bi-film',
            'fotografi' => 'bi-camera-fill',
            'kerajinan' => 'bi-scissors',
            default => 'bi-file-earmark-fill'
        };
    }

    private function renderCollaborators($karya)
    {
        $html = '';
        foreach ($karya->collaborators->take(2) as $collab) {
            $html .= '<i class="bi bi-person-fill"></i> ' . e($collab->name) . ' ';
        }
        return $html;
    }

    public function store(Request $request)
    {
        Log::info('=== UPLOAD PROCESS STARTED ===');
        Log::info('User ID: ' . Auth::id());

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|in:tari,musik,puisi,dokumenter,fotografi,kerajinan',
                'description' => 'required|string',
                'file' => 'required|file|max:51200',
            ]);

            Log::info('Validation passed');

            DB::beginTransaction();

            $file = $request->file('file');

            Log::info('File details:', [
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'is_valid' => $file->isValid()
            ]);

            if (!$file->isValid()) {
                throw new \Exception('File tidak valid');
            }

            // Determine file type
            $fileType = $this->determineFileType($file->getMimeType());

            // Generate filename
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $folder = $this->getStorageFolder($fileType);

            // Store file
            $filePath = $file->storeAs($folder, $fileName, 'public');

            if (!$filePath) {
                throw new \Exception('Gagal menyimpan file');
            }

            // Create record
            $karya = Karya::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'file_path' => $filePath,
                'file_type' => $fileType,
                'user_id' => Auth::id() ?? 1,
                'views' => 0,
                'likes' => 0,
                'downloads' => 0
            ]);

            DB::commit();

            Log::info('Karya created successfully: ' . $karya->id);

            // REDIRECT dengan success message CLEAR
            return redirect()->route('kolaborasi.index')
                ->with('success', 'Karya "' . $validated['title'] . '" berhasil diupload!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi: ' . implode(', ', $e->errors()));
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Upload failed: ' . $e->getMessage());

            // Delete file if exists
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return back()
                ->withInput()
                ->with('error', 'Gagal mengupload karya: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $karya = Karya::with(['user', 'collaborators'])
                ->findOrFail($id);

            // Increment views
            $karya->increment('views');

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $karya->id,
                    'title' => $karya->title,
                    'description' => $karya->description,
                    'category' => $karya->category,
                    'file_path' => $this->getFileUrl($karya->file_path),
                    'file_type' => $karya->file_type,
                    'views' => $karya->views,
                    'likes' => $karya->likes,
                    'downloads' => $karya->downloads,
                    'created_at' => $karya->created_at->diffForHumans(),
                    'user' => [
                        'id' => $karya->user->id,
                        'name' => $karya->user->name,
                        'avatar' => $karya->user->avatar ?? '/default-avatar.png'
                    ],
                    'collaborators' => $karya->collaborators->map(function ($collab) {
                        return [
                            'id' => $collab->id,
                            'name' => $collab->name,
                            'avatar' => $collab->avatar ?? '/default-avatar.png'
                        ];
                    })->toArray(),
                    'is_liked' => Auth::check() ? $karya->isLikedBy(Auth::user()) : false
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Karya tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function download($id)
    {
        $karya = Karya::findOrFail($id);

        $karya->increment('downloads');

        if ($this->isExternalUrl($karya->file_path)) {
            return redirect()->away($karya->file_path);
        }

        $filePath = storage_path('app/public/' . $karya->file_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        $downloadName = Str::slug($karya->title) . '.' . pathinfo($karya->file_path, PATHINFO_EXTENSION);

        return response()->download($filePath, $downloadName);
    }

    public function like($id)
    {
        $karya = Karya::findOrFail($id);
        $user = Auth::user();

        if ($karya->isLikedBy($user)) {
            $karya->likedByUsers()->detach($user->id);
            $karya->decrement('likes');
            $liked = false;
        } else {
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

    private function determineFileType($mimeType)
    {
        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }

        if (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        }

        if (str_starts_with($mimeType, 'image/')) {
            return 'pictures';
        }

        $documentMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain',
            'application/rtf'
        ];

        if (in_array($mimeType, $documentMimes)) {
            return 'document';
        }

        return 'document';
    }

    private function getStorageFolder($fileType)
    {
        $folders = [
            'audio' => 'kolaborasi/audio',
            'video' => 'kolaborasi/video',
            'pictures' => 'kolaborasi/pictures',
            'document' => 'kolaborasi/document'
        ];

        return $folders[$fileType] ?? 'kolaborasi/document';
    }

    private function getFileUrl($filePath)
    {
        if ($this->isExternalUrl($filePath)) {
            return $filePath;
        }

        return Storage::url($filePath);
    }

    private function isExternalUrl($path)
    {
        return filter_var($path, FILTER_VALIDATE_URL) !== false;
    }
}
