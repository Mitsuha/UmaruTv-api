<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function resource($id)
    {
        $videos = Video::with('resource')->where('anime_id',$id)->get();
        $filter_result = array();

        foreach ($videos as $value) {
            foreach ($value['resource'] as $resource) {
                $value['resource'][] = array_except($resource,[
                    'id',
                    'video_id',
                ]);
            }
            $filter_result[] = array_except($value,[
                'id',
                'anime_id',
            ]);
        }

        return $filter_result;
    }
}
