<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;

class LessonContent extends Model
{
    protected $fillable = [
        'lesson_id',
        'word',
        'meaning',
        'example',
        'pronunciations',
        'tip',
        'order',
        'audio_file'
    ];

    protected $casts = [
        'pronunciations' => 'array'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
