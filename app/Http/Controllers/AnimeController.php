<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Tag;
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

    public function split($str)
    {
        return array_filter(explode(',', $str), function($var)
        {
            return !empty($var);
        });
    }

    public function index(Request $request)
    {
        $anime = new Anime();

        if ($request->has('tag')) {
            $ids = $this->split($request->input('tag'));

            $anime = $anime->whereHas('tags',function($query) use ($ids){
                $query->whereIn('tag_id',$ids);
            });
        }

        return $anime->paginate($request->input('paginate')); 
    }

    public function show(Request $request, $id)
    {   
        $with = $request->has('withVideo') ? ['video','tags'] : ['tags'];

        return array_except(Anime::with($with)->findOrFail($id),['id']);
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

    public function recentlyUpdated()
    {
        $video = Video::select('anime_id')->orderBy('created_at','desc')->limit(20)->get()->toArray();
        $video = array_slice(array_unique(array_column($video, 'anime_id')),0,10);

        $anime = Anime::select(['id','name','episodes'])->whereIn('id',$video)->get();
        return $anime;
    }

    public function tags(Request $request)
    {
        if ($request->has('type')) {
            return Tag::where('type',$request->input('type'))->get();
        }
        return Tag::all();
    }
}
