<?php

namespace App\Models\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title',
        'description',
        'difficulty',
        'icon',
        'question_count',
        'participant_count',
        'time_limit',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'question_count' => 'integer',
        'participant_count' => 'integer',
        'time_limit' => 'integer'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }

    public function getBadgeColorAttribute()
    {
        return [
            'mudah' => 'badge-mudah',
            'sedang' => 'badge-sedang',
            'sulit' => 'badge-sulit'
        ][$this->difficulty] ?? 'badge-mudah';
    }

    public function getParticipantCountAttribute()
    {
        return $this->results()->distinct('user_id')->count('user_id');
    }
    public function updateParticipantCount()
    {
        $this->participant_count = $this->results()
            ->distinct('user_id')
            ->count('user_id');
        $this->save();
        return $this->participant_count;
    }
}

