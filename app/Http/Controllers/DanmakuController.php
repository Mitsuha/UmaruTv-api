<?php

namespace App\Http\Controllers;

use App\Models\Danmaku;
use Illuminate\Http\Request;

class DanmakuController extends Controller
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

    public function index(Request $request)
    {
        $danmaku =  Danmaku::where('video_id',$request->input('id'))->get();
        $result = [];
        foreach ($danmaku as $i) {
            $result[] = [
                $i->time,
                (int) $i->type,
                $i->color,
                $i->user_id,
                $i->text,
            ];
        }
        return [
            'code'=>0,
            'data'=>$result
        ];
    }
}
