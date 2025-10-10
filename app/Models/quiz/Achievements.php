<?php

namespace App\Models\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Achievements extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'type',
        'target',
        'points',
        'is_active'
    ];

    protected $casts = [
        'target' => 'integer',
        'points' => 'integer',
        'is_active' => 'boolean'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements')
            ->withPivot('progress', 'is_unlocked', 'unlocked_at')
            ->withTimestamps();
    }

    public function userAchievements()
    {
        return $this->hasMany(UserAchievement::class);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->pivot) {
            return min(100, round(($this->pivot->progress / $this->target) * 100));
        }
        return 0;
    }

    public function getIsUnlockedAttribute()
    {
        return $this->pivot ? $this->pivot->is_unlocked : false;
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
