<?php

namespace App\Models\bahasa;

use Illuminate\Database\Eloquent\Model;
use App\Models\bahasa\Language;

class AudioPhrase extends Model
{
    protected $fillable = [
        'language_id',
        'indonesian',
        'local_language',
        'audio_file',
        'order'
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
