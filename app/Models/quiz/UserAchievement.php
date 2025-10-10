<?php

namespace App\Models\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'achievement_id',
        'progress',
        'is_unlocked',
        'unlocked_at'
    ];

    protected $casts = [
        'progress' => 'integer',
        'is_unlocked' => 'boolean',
        'unlocked_at' => 'datetime'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function achievement()
    {
        return $this->belongsTo(Achievement::class);
    }

    public function unlock()
    {
        $this->update([
            'is_unlocked' => true,
            'unlocked_at' => now(),
            'progress' => $this->achievement->target
        ]);
    }

    public function updateProgress($progress)
    {
        $this->progress = min($this->achievement->target, $progress);

        if ($this->progress >= $this->achievement->target && !$this->is_unlocked) {
            $this->unlock();
        } else {
            $this->save();
        }
    }

    public function getProgressPercentageAttribute()
    {
        return min(100, round(($this->progress / $this->achievement->target) * 100));
    }
}
