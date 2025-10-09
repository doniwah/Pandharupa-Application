<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class UserProgress extends Model
{
    protected $fillable = [
        'user_id',
        'language_id',
        'progress_percentage',
        'completed_lessons',
        'study_time',
        'streak',
        'last_study_date'
    ];

    protected $casts = [
        'last_study_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function updateProgress()
    {
        $totalLessons = $this->language->total_lessons;

        if ($totalLessons > 0) {
            $this->progress_percentage = ($this->completed_lessons / $totalLessons) * 100;
            $this->save();
        }
    }

    public function updateStreak()
    {
        $today = Carbon::today();

        if ($this->last_study_date === null) {
            $this->streak = 1;
            $this->last_study_date = $today;
        } elseif ($this->last_study_date->isSameDay($today)) {
            return;
        } elseif ($this->last_study_date->isYesterday()) {
            $this->streak += 1;
            $this->last_study_date = $today;
        } else {
            $this->streak = 1;
            $this->last_study_date = $today;
        }

        $this->save();
    }
}
