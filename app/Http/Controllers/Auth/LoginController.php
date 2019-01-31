<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
        if (\Auth::user()) {
            throw new AccessDeniedHttpException('重复登录');
        }
        
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
            'exp' => strtotime('+1 min'),
            'nam' => $user->name,
            'mai' => $user->email,
            'uid' => $user->id,
        ], env('APP_KEY'));
    }

    static function issuingJwt($user)
    {
        $jwt = static::createJwt($user);
        return response([
            'code'=>1,
            'status'=>'success',
            'jwt'=>$jwt,
        ],200)->header('Authorization',$jwt)->header('Cache-Control','no-store');
    }
}
