<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'episode_id', 'reply_id', 'content', 'like'
    ];

    public function reply(){
        return $this->hasMany(self::class, 'reply_id');
    }

    static function whereEpisode($id){
        return self::where('episode_id', $id)->whereNull('reply_id')->with('reply');
    }
}
