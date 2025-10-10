<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'karya_id',
        'user_id',
        'comment'
    ];

    public function karya()
    {
        return $this->belongsTo(Karya::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}