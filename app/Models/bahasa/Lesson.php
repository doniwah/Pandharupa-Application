<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'language_id',
        'title',
        'content',
        'level',
        'order'
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function completions()
    {
        return $this->hasMany(LessonCompletion::class);
    }

    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }

    public function learningPaths()
    {
        return $this->belongsToMany(
            LearningPath::class,
            'learning_path_lessons',
            'lesson_id',
            'learning_path_id'
        )->withPivot('order')->withTimestamps();
    }

    public function isCompletedByUser($userId)
    {
        return $this->completions()
            ->where('user_id', $userId)
            ->where('completed', true)
            ->exists();
    }

    public function contents()
    {
        return $this->hasMany(LessonContent::class)->orderBy('order');
    }
}
