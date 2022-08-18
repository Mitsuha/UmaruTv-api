<?php

namespace App\Models;

class Advertising extends Model
{
    protected $table = 'advertising';
    protected $hidden = [
        'id','name','created_at','updated_at'
    ];
}
