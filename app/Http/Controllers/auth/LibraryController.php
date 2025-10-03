<?php

namespace App\Http\Controllers\auth;

use App\Models\Library;
use App\Models\LibraryInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');
        $search = $request->get('search');

        $query = Library::query();

        if ($type !== 'all') {
            $query->where('type', $type);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $libraries = $query->latest()->get();

        // Hitung statistik
        $stats = [
            'total' => Library::count(),
            'naskah' => Library::where('type', 'naskah')->count(),
            'audio_lagu' => Library::whereIn('type', ['audio', 'lagu'])->count(),
            'video_dokumentasi' => Library::whereIn('type', ['video', 'dokumentasi'])->count(),
        ];

        return view('pages.e_library.elibrary', compact('libraries', 'stats', 'type'));
    }

    public function show($id)
    {
        $library = Library::findOrFail($id);

        // Track view
        $this->trackInteraction($library->id, 'view');

        // Increment views
        $library->increment('views');

        return response()->json($library);
    }

    public function download($id)
    {
        $library = Library::findOrFail($id);

        // Track download
        $this->trackInteraction($library->id, 'download');

        // Increment downloads
        $library->increment('downloads');

        $filePath = storage_path('app/' . $library->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath, $library->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
        }

        return response()->json(['error' => 'File tidak ditemukan'], 404);
    }

    private function trackInteraction($libraryId, $type)
    {
        $ipAddress = request()->ip();

        // Cek apakah sudah pernah view/download sebelumnya
        $exists = LibraryInteraction::where('library_id', $libraryId)
            ->where('ip_address', $ipAddress)
            ->where('type', $type)
            ->exists();

        if (!$exists) {
            LibraryInteraction::create([
                'library_id' => $libraryId,
                'ip_address' => $ipAddress,
                'type' => $type,
                'created_at' => now(),
            ]);
        }
    }
}
