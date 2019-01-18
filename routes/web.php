<?php

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

$router->get('/', function () use ($router) {

});

$router->get('/login','Auth\LoginController@login');
$router->post('/register','Auth\RegisterController@register');
$router->get('/user/self',['middleware'=>'auth','uses'=>'UserController@self']);
$router->get('/user/{id}/info',['middleware'=>'auth','uses'=>'UserController@show']);
$router->get('/animes/','AnimeController@index');
$router->get('/animes/{id}/info','AnimeController@show');
$router->get('/animes/{id}/episodes','AnimeController@episodes');
$router->get('/animes/{id}/video','VideoController@resource');
$router->get('/animes/video/{id}/comment','CommentController@show');
$router->post('/comment/create','CommentController@create');
$router->post('/comment/delete','CommentController@delete');