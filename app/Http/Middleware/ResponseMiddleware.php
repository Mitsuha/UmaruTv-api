<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Firebase\JWT\JWT;
use App\Http\Controllers\Auth\LoginController;


class ResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $jwt = $this->getJwtToJson($request);
            echo "JWT";
            if ($this->allowReissue($jwt)) {
                $request->__loginUser = User::find($jwt->uid);
                $response = $next($request);

                if ($time > $jwt->exp) {
                    $newJwt = LoginController::createJwt($request->__loginUser);
                    echo "续签了";
                    $response->header('Authorization',$newJwt)->header('Cache-Control','no-store');
                }
                return $response;
            }
        }catch(\ExpiredException $e){

        }catch(\UnexpectedValueException $e){
            // dd($e);
        }
        return $next($request);
    }

    public function allowReissue($jwt)
    {
        return time() < strtotime('+1 hours', $jwt->exp);
    }

    public function getJwtToJson($request)
    {
        $authorization = $this->getJwt($request);

        return JWT::decode($authorization, env('APP_KEY'), ['HS256']);
    }

    public function getJwt($request)
    {
        return empty($request->headers->get('Authorization'))
            ? $request->input('Authorization') : $request->headers->get('Authorization');
    }
}
