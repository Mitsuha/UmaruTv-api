<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    public function animes(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class,'anime_tags');
    }
}
