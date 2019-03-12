<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Video;
use Illuminate\Http\Request;

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

    public function video($id, Request $request)
    {
        $with = $request->input('with') === 'resource' ? 'resource' : [];
    
        $videos = video::with($with)->where('anime_id',$id)->get();
        // $filter_result = array();

        // foreach ($videos as $value) {
        //     foreach ($value['resource'] as $resource) {
        //         $value['resource'][] = array_except($resource,[
        //             'id',
        //             'video_id',
        //         ]);
        //     }
        //     $filter_result[] = array_except($value,[
        //         'id',
        //         'anime_id',
        //     ]);
        // }

        return $videos;
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
