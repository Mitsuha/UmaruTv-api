<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        // $this->app['auth']->viaRequest('api', function ($request) {
        //     if ($request->input('api_token')) {
        //         return User::where('api_token', $request->input('api_token'))->first();
        //     }
        // });
        
        $this->app['auth']->viaRequest('api', function($request){
            if (env('APP_ENV') == 'local'){
                return User::find(1);
            }

            $authorization = empty($request->headers->get('Authorization'))
                ? $request->input('Authorization') : $request->headers->get('Authorization');

            if ($request->headers->get('Authorization') || $request->input('Authorization')) {
                try{
                    if (($jwt = JWT::decode($authorization, env('APP_KEY'), ['HS256']))) {
                        if (time() < $jwt->exp) {
                            return User::find($jwt->uid);
                        }
                    }
                }catch(\Exception $e){

                }
            }
        });
    }
}
