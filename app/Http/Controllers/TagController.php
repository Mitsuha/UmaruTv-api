<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
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

    //
    public function tags(Request $request)
    {
        if ($request->has('type')) {
            return Tag::where('type',$request->input('type'))->get();
        }
        return $this->assort(Tag::all());
    }

    public function assort($tag)
    {
        $tag = $tag->toArray();
        $tmp = array();
        foreach ($tag as $item) {
            $tmp[$item['type']][] = $item;
        }
        return $tmp;
    }
}
