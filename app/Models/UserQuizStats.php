<?php

// ===== FILE: app/Models/UserQuizStats.php =====

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuizStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_quizzes_taken',
        'total_score',
        'average_score',
        'level',
        'last_quiz_at'
    ];

    protected $casts = [
        'average_score' => 'decimal:2',
        'last_quiz_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateLevel()
    {
        $score = $this->total_score;
        
        if ($score >= 5000) {
            $this->level = 'master';
        } elseif ($score >= 3000) {
            $this->level = 'expert';
        } elseif ($score >= 1500) {
            $this->level = 'advanced';
        } elseif ($score >= 500) {
            $this->level = 'intermediate';
        } else {
            $this->level = 'beginner';
        }
        
        return $this->level;
    }
}