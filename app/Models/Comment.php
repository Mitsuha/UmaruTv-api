<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'episode_id', 'reply_id', 'content', 'like'
    ];

    public function reply(): HasMany
    {
        return $this->hasMany(self::class, 'reply_id');
    }

    static function whereEpisode($id): Builder
    {
        return self::query()->where('episode_id', $id)
            ->whereNull('reply_id')
            ->with('reply');
    }
}
