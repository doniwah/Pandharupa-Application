<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'views'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Cek apakah user sudah like (permanent)
    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // Cek apakah topik sudah terjawab untuk user tertentu
    public function isAnsweredFor($user)
    {
        if (!$user) return false;
        return $this->answeredByUsers()->where('user_id', $user->id)->exists();
    }

    // Relasi many-to-many untuk tracking siapa yang sudah terjawab
    public function answeredByUsers()
    {
        return $this->belongsToMany(User::class, 'topic_user_answered')
            ->withTimestamps();
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    // Mark as answered untuk user tertentu
    public function markAsAnsweredFor($user)
    {
        if (!$this->isAnsweredFor($user)) {
            $this->answeredByUsers()->attach($user->id);
        }
    }
}