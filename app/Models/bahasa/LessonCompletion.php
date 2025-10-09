<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LessonCompletion extends Model
{
    protected $fillable = [
        'user_id',
        'lesson_id',
        'completed',
        'completed_at'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'completed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
