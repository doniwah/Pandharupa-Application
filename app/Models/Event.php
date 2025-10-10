<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_event',
        'kategori',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'tipe_lokasi',
        'kapasitas_peserta',
        'harga_ticket',
        'nama_penyelenggara',
        'email_penyelenggara',
        'no_telepon',
        'icon',
        'rating',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'harga_ticket' => 'decimal:2',
        'rating' => 'decimal:1'
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getTanggalFormatAttribute()
    {
        if ($this->tanggal_selesai && $this->tanggal_mulai != $this->tanggal_selesai) {
            return $this->tanggal_mulai->format('d') . '-' . $this->tanggal_selesai->format('d M Y');
        }
        return $this->tanggal_mulai->format('d M Y');
    }

    public function getWaktuFormatAttribute()
    {
        return substr($this->waktu_mulai, 0, 5) . ' - ' . substr($this->waktu_selesai, 0, 5) . ' WIB';
    }

    public function getHargaFormatAttribute()
    {
        if ($this->harga_ticket == 0) {
            return 'Gratis';
        }
        return 'Rp ' . number_format($this->harga_ticket, 0, ',', '.');
    }

    public function getJumlahPendaftarAttribute()
    {
        return $this->registrations()->count();
    }
}
