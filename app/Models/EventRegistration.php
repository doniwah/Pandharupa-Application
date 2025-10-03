<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'nama_lengkap',
        'email',
        'no_telepon',
        'asal_instansi',
        'status'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
