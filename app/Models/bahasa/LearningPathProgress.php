<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LearningPathProgress extends Model
{
    protected $table = 'learning_path_progress';

    protected $fillable = [
        'user_id',
        'learning_path_id',
        'completed_lessons',
        'progress_percentage',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'progress_percentage' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learningPath()
    {
        return $this->belongsTo(LearningPath::class);
    }

    /**
     * Update progress berdasarkan completed lessons
     */
    public function updateProgress()
    {
        $learningPath = $this->learningPath;
        $totalLessons = $learningPath->lessons()->count();

        if ($totalLessons > 0) {
            $this->progress_percentage = ($this->completed_lessons / $totalLessons) * 100;

            // Mark as completed jika semua lesson selesai
            if ($this->completed_lessons >= $totalLessons && !$this->completed_at) {
                $this->completed_at = now();
            }

            $this->save();
        }
    }
}
