<?php

namespace App\Models\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_score',
        'quizzes_completed',
        'correct_answers',
        'level'
    ];

    protected $casts = [
        'total_score' => 'integer',
        'quizzes_completed' => 'integer',
        'correct_answers' => 'integer'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLevelColorAttribute()
    {
        return [
            'pemula' => 'level-beginner',
            'intermediate' => 'level-intermediate',
            'advanced' => 'level-advanced',
            'expert' => 'level-expert',
            'master' => 'level-master'
        ][$this->level] ?? 'level-beginner';
    }

    public function getLevelIconAttribute()
    {
        return [
            'pemula' => 'bi bi-star',
            'intermediate' => 'bi bi-star-half',
            'advanced' => 'bi bi-stars',
            'expert' => 'bi bi-award',
            'master' => 'bi bi-trophy'
        ][$this->level] ?? 'bi bi-star';
    }

    public function calculateLevel()
    {
        if ($this->total_score >= 5000) return 'master';
        if ($this->total_score >= 3000) return 'expert';
        if ($this->total_score >= 1500) return 'advanced';
        if ($this->total_score >= 500) return 'intermediate';
        return 'pemula';
    }

    public function updateStats()
    {
        $this->level = $this->calculateLevel();
        $this->save();
    }

    public function addScore($points, $correctAnswers = 0)
    {
        $this->total_score += $points;
        $this->correct_answers += $correctAnswers;
        $this->quizzes_completed += 1;
        $this->updateStats();
    }

    public static function getTopUsers($limit = 10)
    {
        return static::with('user')
            ->orderBy('total_score', 'DESC')
            ->orderBy('correct_answers', 'DESC')
            ->limit($limit)
            ->get()
            ->map(function ($item, $index) {
                $item->rank = $index + 1;
                return $item;
            });
    }

    public function getRankAttribute()
    {
        if (!$this->attributes['rank']) {
            $this->attributes['rank'] = static::where('total_score', '>', $this->total_score)
                ->count() + 1;
        }
        return $this->attributes['rank'];
    }
}
