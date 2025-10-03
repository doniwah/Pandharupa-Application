<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'author',
        'year',
        'duration',
        'pages',
        'file_path',
        'views',
        'downloads',
    ];

    protected $casts = [
        'year' => 'integer',
        'pages' => 'integer',
        'views' => 'integer',
        'downloads' => 'integer',
    ];

    public function interactions()
    {
        return $this->hasMany(LibraryInteraction::class);
    }

    public function getTypeIconAttribute()
    {
        return match ($this->type) {
            'naskah' => 'book',
            'lagu' => 'music',
            'video' => 'video',
            'dokumentasi' => 'video',
            'audio' => 'music',
            default => 'book',
        };
    }

    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'naskah' => 'Naskah',
            'lagu' => 'Lagu',
            'video' => 'Video',
            'dokumentasi' => 'Dokumentasi',
            'audio' => 'Audio',
            default => 'Naskah',
        };
    }
}