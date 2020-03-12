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

$router->get('/', function () {
    return "API DOC HERE";
});

$router->group(['prefix' => 'api', 'middleware' => 'keyAccess'], function () use ($router) {
    $router->get('list', [
        'as' => 'rate.list', 
        'uses' => 'RateController@get'
    ]);
    
    $router->get('converter/{from}/{to}/{price}', [
        'as' => 'convert.value', 
        'uses' => 'ConverterController@values'
    ]);
    
    $router->get('history/{value}', [
        'as' => 'hisotry.value', 
        'uses' => 'ValueController@history'
    ]);
});


