<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'icon',
        'kategori',
        'warna_kategori',
        'jumlah_pelajaran',
        'durasi',
        'url_kelas',
        'status',
        'urutan',
    ];
    public function pelajaran()
    {
        return $this->hasMany(Pelajaran::class, 'kelas_id');
    }
}