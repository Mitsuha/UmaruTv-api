<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Episodes extends Model
{

    public function resource(): HasMany
    {
    	return $this->hasMany(Resource::class,'episode_id');
    }
}
