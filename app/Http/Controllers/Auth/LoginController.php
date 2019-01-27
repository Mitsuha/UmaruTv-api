<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class LoginController extends Controller
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

    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        
        if (null == $user){
            throw new NotFoundHttpException('用户不存在');
        }

        if (Hash::check($request->password, $user->password) ) {
            return $this->issuingJwt($user);
        }

        throw new UnauthorizedHttpException('Wrong user name or password', '用户名或密码错误');
    }

    static function createJwt($user){
        return JWT::encode([
            "iss" => env('APP_URL'),
            "iat" => time(),
            'exp' => strtotime('+1 hours'),
            'nam' => $user->name,
            'mai' => $user->email,
            'uid' => $user->id,
        ], env('APP_KEY'));
    }

    static function issuingJwt($user)
    {
        return response([
            'status'=>'success',
            'jwt'=>static::createJwt($user);
        ],200);
    }
}
