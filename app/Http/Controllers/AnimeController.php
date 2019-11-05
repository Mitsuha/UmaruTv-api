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

        return $anime->orderBy('id','desc')->paginate($request->input('paginate'));
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

    public function search(Request $request)
    {
        $name = $request->input('name');
        if ($name){
            return Anime::where('name','like',"%$name%")->limit(10)->get();
        }
    }
}
