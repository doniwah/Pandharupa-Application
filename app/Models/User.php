<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\bahasa\UserProgress;
use App\Models\bahasa\LessonCompletion;
use App\Models\quiz\QuizResult;
use App\Models\quiz\Achievements;
use App\Models\quiz\UserAchievement;
use App\Models\quiz\Leaderboard;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function lessonCompletions()
    {
        return $this->hasMany(LessonCompletion::class);
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class);
    }

public function achievements()
{
    return $this->belongsToMany(
        \App\Models\quiz\Achievements::class,
        'user_achievements',
        'user_id',
        'achievement_id'
    )->withPivot('progress', 'is_unlocked', 'unlocked_at')
     ->withTimestamps();
}

    public function userAchievements()
    {
        return $this->hasMany(UserAchievement::class);
    }

    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class);
    }

    public function getTotalScoreAttribute()
    {
        return $this->leaderboard ? $this->leaderboard->total_score : 0;
    }

    public function getQuizCountAttribute()
    {
        return $this->quizResults()->count();
    }

    public function getCorrectAnswersCountAttribute()
    {
        return $this->quizResults()->sum('correct_answers');
    }

    public function getLevelAttribute()
    {
        return $this->leaderboard ? $this->leaderboard->level : 'pemula';
    }

    public function getUnlockedAchievementsAttribute()
    {
        return $this->achievements()->wherePivot('is_unlocked', true)->get();
    }

    public function getInProgressAchievementsAttribute()
    {
        return $this->achievements()->wherePivot('is_unlocked', false)->get();
    }

    public function quizStats()
    {
        return $this->hasOne(UserQuizStats::class);
    }
}
