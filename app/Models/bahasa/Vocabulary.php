<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    protected $fillable = [
        'language_id',
        'lesson_id',
        'indonesian',
        'local_language',
        'pronunciation',
        'audio_file'
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
