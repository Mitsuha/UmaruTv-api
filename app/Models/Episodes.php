<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{

    public function resource()
    {
    	return $this->hasMany(Resource::class,'episode_id');
    }
}
