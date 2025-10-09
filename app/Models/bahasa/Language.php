<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;
use App\Models\bahasa\LearningPath;
use App\Models\bahasa\UserProgress;
use App\Models\bahasa\Lesson;
use App\Models\bahasa\Vocabulary;
use App\Models\bahasa\AudioPhrase;

class Language extends Model
{
    protected $fillable = [
        'name',
        'native_name',
        'difficulty',
        'indicator_color',
        'speakers',
        'total_lessons',
        'description'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }

    public function audioPhrases()
    {
        return $this->hasMany(AudioPhrase::class);
    }

    public function getUserProgress($userId)
    {
        return $this->userProgress()
            ->where('user_id', $userId)
            ->first();
    }

    public function learningPaths()
    {
        return $this->hasMany(LearningPath::class);
    }
}
