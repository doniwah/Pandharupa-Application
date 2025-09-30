<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    protected $table = 'koleksi';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'penulis',
        'tahun',
        'halaman',
        'durasi',
        'jumlah_suka',
        'jumlah_unduh',
        'file_path',
    ];
}