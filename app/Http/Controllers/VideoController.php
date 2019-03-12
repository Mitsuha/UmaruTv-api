<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

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

    public function resource($id, Request $request)
    {
        $video = Video::with('resource')->find($id);

        if ($request->input('info')==true) {
            return $video;
        }

        return $video->resource;
    }
}
