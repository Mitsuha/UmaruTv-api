<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function (Request $request) use ($router) {
	new App\Models\User();
	// return response($request->cookie('token'))->cookie(cookie('token','aa'));
	$anime = App\Models\Anime::where('status','end')->get();
	// dd($anime);
	return $anime->toArray();
});


$router->group(['prefix'=>'auth','namespace'=>'Auth'],function() use($router){
	$router->post('login', 'AuthController@login');
	$router->post('logout', 'AuthController@logout');
	$router->post('refresh', 'AuthController@refresh');
	$router->post('register','RegisterController@register');
});
 
$router->get('/user/me',['middleware'=>'auth:api','uses'=>'UserController@self']);
$router->get('/user/{id}/info',['middleware'=>'auth:api','uses'=>'UserController@show']);
$router->get('/animes/','AnimeController@index');
$router->get('/animes/timeline','AnimeController@timeline');
$router->get('/animes/recently-updated','AnimeController@recentlyUpdated');
$router->get('/animes/search','AnimeController@search');

$router->get('/animes/{id}/info','AnimeController@show');
$router->get('/animes/{id}/video','AnimeController@video');
$router->get('/animes/tags','TagController@tags');
$router->get('/animes/tags/index','AnimeController@index');
$router->get('/animes/video/{id}/resource','VideoController@resource');
$router->get('/animes/video/{id}/comment','CommentController@show');
$router->get('/animes/video/danmaku/v3/','DanmakuController@index');
$router->post('/animes/video/danmaku/v3/','DanmakuController@create');
$router->post('/comment/create','CommentController@create');
$router->post('/comment/delete','CommentController@delete');