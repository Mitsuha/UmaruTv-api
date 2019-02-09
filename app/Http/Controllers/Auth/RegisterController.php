<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);

        if (\Auth::check()) {
            throw new AccessDeniedHttpException();
        }
        $data = $request->toArray();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $auth = app(AuthController::class);
        return $auth->login($request);
    }
}
