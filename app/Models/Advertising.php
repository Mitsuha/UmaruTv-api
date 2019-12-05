<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    protected $table = 'advertising';
    protected $hidden = [
        'id','name','created_at','updated_at'
    ];
}
