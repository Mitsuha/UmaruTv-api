<?php

namespace App\Http\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
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

    public function register(Request $request)
    {
        $this->vaildate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ])
        $user = User::create($request->toArray());
        return LoginController::issuingJwt($user);
    }
}
