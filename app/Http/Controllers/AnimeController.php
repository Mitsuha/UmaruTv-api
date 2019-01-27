<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Video;

class AnimeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // parent::__construct();
    }

    public function index(Request $request)
    {
        return Anime::withVideo($request->has('withVideo'))->paginate(); 
    }

    public function show(Request $request, $id)
    {
        return array_except(Anime::withVideo($request->has('withVideo'))->findOrFail($id),['id']);
    }

    public function episodes($id)
    {
        return Video::where('anime_id',$id)->get();
    }

    public function FunctionName($value='')
    {
        # code...
    }

    public function timeline()
    {
        $animes = Anime::where('status','updating')->orWhere('status','stop')->get();
        $tmp = array();
        foreach (range(1, 7) as $key) {
            $tmp[$key] = array_filter($animes->toArray(), function($anime) use ($key){
                if ($anime['update_time'] == $key) {
                    return true;
                }
            });
        }
        return $tmp;
    }
}
