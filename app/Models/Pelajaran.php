<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelajaran extends Model
{
    use HasFactory;

    protected $table = 'pelajaran';

    protected $fillable = [
        'kelas_id',
        'judul',
        'durasi',
        'deskripsi',
        'urutan',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}