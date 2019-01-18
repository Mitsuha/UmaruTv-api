<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    
    public function resource()
    {
    	return $this->hasMany(Resource::class,'video_id');
    }
}
