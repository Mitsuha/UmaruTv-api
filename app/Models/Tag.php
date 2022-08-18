<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    public function animes(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class,'anime_tags');
    }
}
