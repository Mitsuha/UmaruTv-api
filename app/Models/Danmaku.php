<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Danmaku extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'episode_id', 'color', 'type', 'text', 'time'];

}
