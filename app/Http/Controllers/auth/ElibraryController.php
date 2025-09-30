<?php

namespace App\Http\Controllers\auth;

use App\Models\Koleksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ElibraryController extends Controller
{
    public function index()
    {
        $koleksi = Koleksi::all()->map(function ($item) {
            // Auto calculate file information for Audio/Lagu/Video/Dokumentasi
            if (in_array($item->kategori, ['Audio', 'Lagu', 'Video', 'Dokumentasi']) && $item->file_path) {
                $filePath = storage_path('app/public/' . $item->file_path);

                if (file_exists($filePath)) {
                    // Get file size
                    $item->ukuran = $this->formatBytes(filesize($filePath));

                    // Get format from extension
                    $extension = strtoupper(pathinfo($filePath, PATHINFO_EXTENSION));
                    $item->format = $extension;

                    // Set kualitas based on file type
                    if (in_array($item->kategori, ['Audio', 'Lagu'])) {
                        // Untuk audio, bisa set default atau coba detect dari metadata
                        $item->kualitas = $this->getAudioQuality($filePath, $extension);
                    }

                    // Calculate duration if not set (for audio/video)
                    if (!$item->durasi && in_array($extension, ['MP3', 'MP4', 'AVI', 'MKV', 'WAV'])) {
                        $item->durasi = $this->getMediaDuration($filePath);
                    }
                }
            }

            return $item;
        });

        return view('pages.e_library.elibrary', compact('koleksi'));
    }

    public function unduh($id)
    {
        $item = Koleksi::findOrFail($id);

        // Tambah jumlah unduh
        $item->increment('jumlah_unduh');

        $filePath = storage_path('app/public/' . $item->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, $item->judul . '.' . pathinfo($item->file_path, PATHINFO_EXTENSION));
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Get audio quality (bitrate)
     * Requires getID3 library or ffmpeg
     */
    private function getAudioQuality($filePath, $extension)
    {
        // Option 1: Using getID3 (Install: composer require james-heinrich/getid3)
        if (class_exists('\getID3')) {
            try {
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze($filePath);

                if (isset($fileInfo['audio']['bitrate'])) {
                    $bitrate = round($fileInfo['audio']['bitrate'] / 1000); // Convert to kbps
                    return $bitrate . ' kbps';
                }
            } catch (\Exception $e) {
                // Fall through to default
            }
        }

        // Option 2: Using ffmpeg/ffprobe (if installed on server)
        if ($this->commandExists('ffprobe')) {
            try {
                $command = "ffprobe -v error -show_entries format=bit_rate -of default=noprint_wrappers=1:nokey=1 " . escapeshellarg($filePath);
                $output = shell_exec($command);

                if ($output) {
                    $bitrate = round(intval($output) / 1000); // Convert to kbps
                    return $bitrate . ' kbps';
                }
            } catch (\Exception $e) {
                // Fall through to default
            }
        }

        // Default quality based on file size (estimation)
        $fileSize = filesize($filePath);

        // Rough estimation: if file is large, assume higher quality
        if ($fileSize > 10 * 1024 * 1024) { // > 10MB
            return '320 kbps';
        } elseif ($fileSize > 5 * 1024 * 1024) { // > 5MB
            return '192 kbps';
        } else {
            return '128 kbps';
        }
    }

    /**
     * Get media duration
     * Requires getID3 library or ffmpeg
     */
    private function getMediaDuration($filePath)
    {
        // Option 1: Using getID3
        if (class_exists('\getID3')) {
            try {
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze($filePath);

                if (isset($fileInfo['playtime_seconds'])) {
                    return $this->formatDuration($fileInfo['playtime_seconds']);
                }
            } catch (\Exception $e) {
                // Fall through to ffmpeg
            }
        }

        // Option 2: Using ffmpeg/ffprobe
        if ($this->commandExists('ffprobe')) {
            try {
                $command = "ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 " . escapeshellarg($filePath);
                $output = shell_exec($command);

                if ($output) {
                    return $this->formatDuration(floatval($output));
                }
            } catch (\Exception $e) {
                // Return null if failed
            }
        }

        return null;
    }

    /**
     * Format duration from seconds to HH:MM:SS
     */
    private function formatDuration($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = floor($seconds % 60);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    /**
     * Check if command exists on server
     */
    private function commandExists($command)
    {
        $return = shell_exec(sprintf("which %s", escapeshellarg($command)));
        return !empty($return);
    }
}