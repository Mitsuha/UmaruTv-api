<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;

class UserController extends Controller
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

    public function show($id){

        return array_except(User::findOrFail($id), [
            'bbs_id',
            'password',
            'remember_token',
            'updated_at'
        ]);
    }

    public function self(){

        return array_except(Auth::user(), [
            'password',
            'remember_token'
        ]);
    }
}
