<?php

namespace App\Models\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class QuizResult extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'time_taken',
        'correct_answers',
        'total_questions',
        'score',
        'percentage',
        'answers',
        'completed_at'
    ];

    protected $casts = [
        'time_taken' => 'integer',
        'correct_answers' => 'integer',
        'total_questions' => 'integer',
        'score' => 'integer',
        'percentage' => 'decimal:2',
        'answers' => 'array',
        'completed_at' => 'datetime'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getGradeAttribute()
    {
        if ($this->percentage >= 90) return 'A';
        if ($this->percentage >= 80) return 'B';
        if ($this->percentage >= 70) return 'C';
        if ($this->percentage >= 60) return 'D';
        return 'E';
    }

    public function getTimeTakenFormattedAttribute()
    {
        $minutes = floor($this->time_taken / 60);
        $seconds = $this->time_taken % 60;
        return "{$minutes}:" . str_pad($seconds, 2, '0', STR_PAD_LEFT);
    }

    public function isPerfectScore()
    {
        return $this->percentage == 100;
    }

    public function getCorrectAnswersCount()
    {
        return $this->correct_answers;
    }

    public function getWrongAnswersCount()
    {
        return $this->total_questions - $this->correct_answers;
    }

    // TAMBAHKAN METHOD INI
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByQuiz($query, $quizId)
    {
        return $query->where('quiz_id', $quizId);
    }

    public static function getBestScore($userId, $quizId)
    {
        return self::where('user_id', $userId)
            ->where('quiz_id', $quizId)
            ->max('score');
    }
}