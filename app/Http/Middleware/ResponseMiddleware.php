<?php

namespace App\Http\Middleware;

use Closure;

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
        
        // $authorization = empty($request->headers->get('Authorization'))
        //     ? $request->input('Authorization') : $request->headers->get('Authorization');

        // // dd($authorization);
        // if ($authorization) {
        //     try{
        //         if (($jwt = JWT::decode($authorization, env('APP_KEY'), ['HS256']))) {
        //             if (time() < $jwt->exp) {
        //                 return User::find($jwt->uid);
        //             }
        //         }
        //     }catch(\Exception $e){

        //     }
        // }
        return $next($request);
    }
}
