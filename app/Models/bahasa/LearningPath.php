<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;
use App\Models\bahasa\LearningPathProgress;

class LearningPath extends Model
{
    protected $fillable = [
        'language_id',  // TAMBAHKAN INI
        'name',
        'level',
        'description',
        'total_lessons',
        'order'
    ];

    public function lessons()
    {
        return $this->belongsToMany(
            Lesson::class,
            'learning_path_lessons',
            'learning_path_id',
            'lesson_id'
        )->withPivot('order')->withTimestamps()->orderBy('learning_path_lessons.order');
    }

    public function progress()
    {
        return $this->hasMany(LearningPathProgress::class);
    }

    /**
     * Relasi ke language
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get progress untuk user tertentu
     */
    public function getUserProgress($userId)
    {
        return $this->progress()
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * Get progress percentage untuk user
     */
    public function getProgressPercentage($userId)
    {
        $progress = $this->getUserProgress($userId);
        return $progress ? $progress->progress_percentage : 0;
    }
}
