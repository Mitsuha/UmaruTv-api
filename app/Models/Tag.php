<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    public function animes()
    {
        return $this->belongsToMany(Anime::class,'anime_tags');
    }


}
