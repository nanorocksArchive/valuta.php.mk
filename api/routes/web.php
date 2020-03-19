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
    return response([
        'info' => "API v.2.0",
        'support' => [
            'accessKey' => true,
        ],
        'describe' => [
            '/api/list' => [
                'request' => [
                    'method' => 'post',
                    'header' => [
                        'content-type' => 'application/json'
                    ],
                    'body' => [
                        'accessKey' => true
                    ]
                ],
                'response' => [
                    'type' => 'json',
                    'data' => '...'
                ]
            ],
            '/api/converter/{from}/{to}/{price}' => [
                'request' => [
                    'method' => 'post',
                    'header' => [
                        'content-type' => 'application/json'
                    ],
                    'body' => [
                        'accessKey' => true
                    ]
                ],
                'response' => [
                    'type' => 'json',
                    'data' => '...'
                ]
            ],
            '/api/history/{value}' => [
                'request' => [
                    'method' => 'post',
                    'header' => [
                        'content-type' => 'application/json'
                    ],
                    'body' => [
                        'accessKey' => true
                    ]
                ],
                'response' => [
                    'type' => 'json',
                    'data' => '...'
                ]
            ]
        ]

    ], 200)
        ->header('Content-Type', 'application/json');
});

$router->group(['prefix' => 'api', 'middleware' => 'keyAccess'], function () use ($router) {
    $router->post('list', [
        'as' => 'rate.list',
        'uses' => 'RateController@get'
    ]);

    $router->post('converter/{from}/{to}/{price}', [
        'as' => 'convert.value',
        'uses' => 'ConverterController@values'
    ]);

    $router->post('history/{value}', [
        'as' => 'history.value',
        'uses' => 'ValueController@history'
    ]);
});


