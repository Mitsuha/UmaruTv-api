<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use Illuminate\Http\Request;

class EpisodeController extends Controller
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
        $episode = Episodes::with('resource')->find($id);

        if ($request->input('info')==true) {
            return $episode;
        }

        return $episode->resource;
    }
}
