<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryInteraction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'library_id',
        'ip_address',
        'type',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}