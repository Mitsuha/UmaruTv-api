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
use Tymon\JWTAuth\JWTAuth;


class AuthController extends Controller
{
    protected $jwt_auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt_auth)
    {
        $this->middleware('auth:api',['except'=>'login']);
        $this->jwt_auth = $jwt_auth;
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if (\Auth::check()) {
            throw new AccessDeniedHttpException('重复登录');
        }

        if (! $token = $this->jwt_auth->attempt($request->only('email','password'))) {
            throw new UnauthorizedHttpException('Wrong user name or password', '用户名或密码错误');
        }

        return [
            'code'=>1,
            'status'=>'success',
            'token'=>$token,
        ];
    }

    public function logout()
    {
        $this->jwt_auth->parseToken()->invalidate();
        return [
            'code'=>1,
            'status'=>'success',
            'message'=>'退出成功',
        ];
    }

    public function refresh()
    {
        $token = $this->jwt_auth->parseToken()->refresh();

        return [
            'code'=>1,
            'status'=>'success',
            'token'=>$token
        ];
    }
}