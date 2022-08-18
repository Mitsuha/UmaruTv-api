<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anime extends Model
{
    public function episode(): HasMany
    {
        return $this->hasMany(Episodes::class, 'anime_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'anime_tags');
    }

    public function scopeWithEpisode($query, bool $with)
    {
        if ($with) {
            return $query->with('episode');
        } else {
            return $query;
        }
    }
}
