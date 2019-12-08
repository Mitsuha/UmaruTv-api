<?php

namespace App\Http\Controllers;

use App\Models\Danmaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $danmaku =  Danmaku::where('episode_id',$request->input('id'))->get();
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

    public function create(Request $request)
    {
        $data = array_merge($request->toArray(), [
            'user_id' =>Auth::id(),
            'episode_id'=>$request->input('id'),
        ]);
        return Danmaku::create($data);
    }
}
