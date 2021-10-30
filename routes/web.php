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

$router->get('/', [
    'as' => '/', 'uses' => 'Controller@index'
]);
$router->get('/telegram', [
    'as' => 'telegram', 'uses' => 'TelegramController@index'
]);
$router->get('/telegram/get_me', [
    'as' => '/telegram/get_me', 'uses' => 'TelegramController@getMe'
]);
$router->post('/telegram/auth', [
    'as' => 'telegram/auth', 'uses' => 'TelegramController@auth'
]);

$router->get('/tools', [
    'as' => '/tools', 'uses' => 'ToolsController@index'
]);
