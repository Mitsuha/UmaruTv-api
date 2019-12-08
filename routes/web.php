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


//Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
//	Route::post('login', 'LoginController@login');
//	Route::post('logout', 'AuthController@logout');
//	Route::post('refresh', 'AuthController@refresh');
//	Route::post('register','RegisterController@register');
//});


Route::get('/carousel/{name}','IndexController@carousel');
Route::get('/user/{id}/info','UserController@show');
Route::get('/animes/','AnimeController@index');
Route::get('/animes/timeline','AnimeController@timeline');
Route::get('/animes/recently-updated','AnimeController@recentlyUpdated');
Route::get('/animes/search','AnimeController@search');

Route::get('/animes/{id}/info','AnimeController@show');
Route::get('/animes/{id}/episode','AnimeController@episode');
Route::get('/animes/tags','TagController@tags');
Route::get('/animes/tags/index','AnimeController@index');
Route::get('/animes/episode/{id}/resource','EpisodeController@resource');
Route::get('/animes/episode/{id}/comment','CommentController@show');
Route::get('/animes/episode/danmaku/v3/','DanmakuController@index');
//Route::options('/animes/episode/danmaku/v3/','DanmakuController@index');


Route::middleware('auth')->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/me',['middleware'=>'auth','uses'=>'UserController@self']);
    Route::post('/comment/create','CommentController@create');
    Route::post('/comment/delete','CommentController@delete');
    Route::post('/animes/episode/danmaku/v3/','DanmakuController@create');
});
