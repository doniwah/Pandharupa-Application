<?php

namespace App\Http\Controllers\auth;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'Semua');

        // Statistik
        $stats = [
            'total_events' => Event::where('status', 'approved')->count(),
            'total_peserta' => EventRegistration::count(),
            'events_mendatang' => Event::where('status', 'approved')
                ->where('tanggal_mulai', '>=', now())
                ->count(),
            'kepuasan' => 95
        ];

        // Event Unggulan (upcoming events)
        $eventUnggulan = Event::where('status', 'approved')
            ->where('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai', 'asc')
            ->take(2)
            ->get();

        // Event Mendatang
        $query = Event::where('status', 'approved')
            ->where('tanggal_mulai', '>=', now());

        if ($kategori !== 'Semua') {
            $query->where('kategori', $kategori);
        }

        $eventMendatang = $query->orderBy('tanggal_mulai', 'asc')->get();

        return view('pages.events.events', compact('stats', 'eventUnggulan', 'eventMendatang', 'kategori'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        // Hitung jumlah pendaftar
        $jumlahPendaftar = EventRegistration::where('event_id', $id)->count();

        return response()->json([
            'event' => $event,
            'jumlah_pendaftar' => $jumlahPendaftar
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'kategori' => 'required|in:Workshop,Festival,Webinar,Kompetisi,Pertunjukan',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required|string',
            'kapasitas_peserta' => 'required|integer|min:1',
            'harga_ticket' => 'required|numeric|min:0',
            'nama_penyelenggara' => 'required|string',
            'email_penyelenggara' => 'required|email',
            'no_telepon' => 'required|string',
        ]);

        $validated['status'] = 'pending';
        $validated['rating'] = 0;

        $event = Event::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Event berhasil diajukan dan menunggu persetujuan',
            'event' => $event
        ]);
    }

    public function register(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telepon' => 'required|string',
            'asal_instansi' => 'nullable|string',
        ]);

        $event = Event::findOrFail($id);

        // Cek kapasitas
        $jumlahPendaftar = EventRegistration::where('event_id', $id)->count();
        if ($jumlahPendaftar >= $event->kapasitas_peserta) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, kapasitas event sudah penuh'
            ], 400);
        }

        $validated['event_id'] = $id;
        $registration = EventRegistration::create($validated);

        // Format nomor WA (hilangkan karakter non-digit dan tambahkan 62 jika dimulai dengan 0)
        $waNumber = preg_replace('/[^0-9]/', '', $event->no_telepon);
        if (substr($waNumber, 0, 1) === '0') {
            $waNumber = '62' . substr($waNumber, 1);
        }

        // Format pesan WhatsApp
        $message = "Halo, saya ingin mendaftar untuk event:\n\n";
        $message .= "Event: {$event->nama_event}\n";
        $message .= "Nama: {$validated['nama_lengkap']}\n";
        $message .= "Email: {$validated['email']}\n";
        $message .= "No. Telepon: {$validated['no_telepon']}\n";
        if (!empty($validated['asal_instansi'])) {
            $message .= "Asal Instansi: {$validated['asal_instansi']}\n";
        }

        $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($message);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil',
            'whatsapp_url' => $waUrl
        ]);
    }
}
