<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    
    public function video()
    {
    	return $this->hasMany(Video::class,'anime_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'anime_tags');
    }

    public function scopeWithVideo($query, bool $with)
    {
    	if ($with) {
    		return $query->with('video');
    	}else{
    		return $query;
    	}
    }
}
