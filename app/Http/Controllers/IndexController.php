<?php


namespace App\Http\Controllers;


use App\Models\Advertising;
use App\Models\Config;
use Illuminate\Support\Facades\Request;

class IndexController extends Controller
{
    public function carousel(){
        return Advertising::where('name', 'carousel')->get();
    }
}