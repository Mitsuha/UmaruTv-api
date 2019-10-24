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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function (Request $request) {
	$anime = App\Models\Anime::where('status','end')->get();
	return $anime->toArray();
});


Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
	Route::post('login', 'AuthController@login');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
	Route::post('register','RegisterController@register');
});
 
Route::get('/user/me',['middleware'=>'auth:api','uses'=>'UserController@self']);
Route::get('/user/{id}/info',['middleware'=>'auth:api','uses'=>'UserController@show']);
Route::get('/animes/','AnimeController@index');
Route::get('/animes/timeline','AnimeController@timeline');
Route::get('/animes/recently-updated','AnimeController@recentlyUpdated');
Route::get('/animes/search','AnimeController@search');

Route::get('/animes/{id}/info','AnimeController@show');
Route::get('/animes/{id}/video','AnimeController@video');
Route::get('/animes/tags','TagController@tags');
Route::get('/animes/tags/index','AnimeController@index');
Route::get('/animes/video/{id}/resource','VideoController@resource');
Route::get('/animes/video/{id}/comment','CommentController@show');
Route::get('/animes/video/danmaku/v3/','DanmakuController@index');
Route::post('/animes/video/danmaku/v3/','DanmakuController@create');
Route::post('/comment/create','CommentController@create');
Route::post('/comment/delete','CommentController@delete');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
