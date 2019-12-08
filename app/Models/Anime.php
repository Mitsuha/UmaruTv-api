<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{

    public function episode()
    {
    	return $this->hasMany(Episodes::class,'anime_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'anime_tags');
    }

    public function scopeWithEpisode($query, bool $with)
    {
    	if ($with) {
    		return $query->with('episode');
    	}else{
    		return $query;
    	}
    }
}
