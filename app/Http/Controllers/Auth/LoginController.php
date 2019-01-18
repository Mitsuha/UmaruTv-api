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
        $request->email='yblick@example.net';
        $request->password = 'secret';

        $user = User::where('email',$request->email)->first();
        
        if (null == $user){
            throw new NotFoundHttpException('用户不存在');
        }

        if (Hash::check($request->password, $user->password) ) {
            return $this->createJwt($user);
        }

        throw new UnauthorizedHttpException('Wrong user name or password', '用户名或密码错误');
    }

    public function createJwt($user){
        $jwt = JWT::encode([
            "iss" => "http://example.org",
//            "aud" => "http://example.com",
            "iat" => time(),
//            "nbf" => time(),
            'exp' => strtotime('+1 hours'),
            'nam' => $user->name,
            'mai' => $user->email,
            'uid' => $user->id,
        ], env('APP_KEY'));

        return response([
            'status'=>'success',
            'jwt'=>$jwt
        ],200);
    }
}
