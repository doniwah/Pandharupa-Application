<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karya extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'file_path',
        'file_type',
        'thumbnail',
        'views',
        'likes',
        'downloads',
        'is_featured',
        'user_id'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Relasi dengan User (pemilik karya)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan kolaborator
    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'karya_collaborators');
    }

    // Relasi dengan komentar
    public function comments()
    {
        return $this->hasMany(KaryaComment::class);
    }

    // Relasi dengan likes
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'karya_likes')->withTimestamps();
    }

    // Helper method untuk cek apakah user sudah like
    public function isLikedBy($user)
    {
        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }

    // Increment downloads
    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    // Scope untuk filter kategori
    public function scopeCategory($query, $category)
    {
        if ($category && $category !== 'semua') {
            return $query->where('category', $category);
        }
        return $query;
    }

    // Scope untuk karya featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk karya terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Scope untuk karya terpopuler
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }
}