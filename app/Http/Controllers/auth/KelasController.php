<?php

namespace App\Http\Controllers\auth;

use App\Models\Kelas;
use App\Models\Progress;
use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{


    public function index()
    {
        $kelasList = DB::table('kelas')
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        $stats = [
            'total_materi' => DB::table('kelas')->sum('jumlah_pelajaran'),
            'pelajar_aktif' => 2450,
            'tingkat_kepuasan' => 98,
            'akses' => '24/7'
        ];

        return view('pages.kelas_nusantara.kelas', compact('kelasList', 'stats'));
    }

    /**
     * Display the specified class with all lessons
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        $pelajaran = Pelajaran::where('kelas_id', $id)
            ->orderBy('urutan', 'asc')
            ->get();

        return view('pages.kelas_nusantara.detail_kelas', compact('kelas', 'pelajaran'));
    }

    /**
     * Display a specific lesson for reading
     */
    public function bacaPelajaran($kelasId, $pelajaranId)
    {
        $kelas = Kelas::with('pelajaran')->findOrFail($kelasId);
        $pelajaran = Pelajaran::where('kelas_id', $kelasId)->findOrFail($pelajaranId);

        // Update progress if user is authenticated
        if (Auth::check()) {
            Progress::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'pelajaran_id' => $pelajaranId,
                ],
                [
                    'status' => 'sedang_belajar'
                ]
            );
        }

        // Get previous lesson
        $previous = Pelajaran::where('kelas_id', $kelasId)
            ->where('urutan', '<', $pelajaran->urutan)
            ->orderBy('urutan', 'desc')
            ->first();

        // Get next lesson
        $next = Pelajaran::where('kelas_id', $kelasId)
            ->where('urutan', '>', $pelajaran->urutan)
            ->orderBy('urutan', 'asc')
            ->first();

        return view('pages.kelas_nusantara.baca_pelajaran', compact('kelas', 'pelajaran', 'previous', 'next'));
    }

    /**
     * Update lesson progress (for auto-save)
     */
    public function updateProgress(Request $request, $kelasId, $pelajaranId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        $validated = $request->validate([
            'status' => 'required|in:belum_mulai,sedang_belajar,selesai'
        ]);

        try {
            $progress = Progress::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'pelajaran_id' => $pelajaranId,
                ],
                [
                    'status' => $validated['status']
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Progress berhasil diupdate',
                'data' => [
                    'status' => $progress->status
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark lesson as complete
     */
    public function markComplete(Request $request, $kelasId, $pelajaranId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        try {
            $progress = Progress::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'pelajaran_id' => $pelajaranId,
                ],
                [
                    'status' => 'selesai'
                ]
            );

            // Get completion percentage for this class
            $totalLessons = Pelajaran::where('kelas_id', $kelasId)->count();
            $completedLessons = Progress::where('user_id', Auth::id())
                ->where('status', 'selesai')
                ->whereIn('pelajaran_id', function ($query) use ($kelasId) {
                    $query->select('id')
                        ->from('pelajaran')
                        ->where('kelas_id', $kelasId);
                })
                ->count();

            $percentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

            return response()->json([
                'success' => true,
                'message' => 'Pelajaran berhasil ditandai selesai',
                'data' => [
                    'completed' => $completedLessons,
                    'total' => $totalLessons,
                    'percentage' => $percentage
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user progress for a specific class
     */
    public function getProgress($kelasId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        $totalLessons = Pelajaran::where('kelas_id', $kelasId)->count();

        $completedLessons = Progress::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->whereIn('pelajaran_id', function ($query) use ($kelasId) {
                $query->select('id')
                    ->from('pelajaran')
                    ->where('kelas_id', $kelasId);
            })
            ->count();

        $percentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'completed' => $completedLessons,
                'total' => $totalLessons,
                'percentage' => $percentage
            ]
        ]);
    }
}
