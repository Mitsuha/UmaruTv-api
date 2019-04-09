<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Danmaku extends Model
{
    protected $fillable = ['user_id', 'video_id', 'color', 'type', 'text', 'time'];

    
}
