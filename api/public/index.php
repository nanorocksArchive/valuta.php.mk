<?php
/**
 * Composer
 */
require_once __DIR__ . './../vendor/autoload.php';

/**
 * ENV INS
 */
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

/**
 * ENV VARS
 */
$apiEndpoints = getenv('API_CONTENT');
$url = getenv('URL');


/**
 * Routes
 */
Flight::route('GET /', function() use ($apiEndpoints) {
    echo "<pre>" . $apiEndpoints . "</pre>";
    die();
});

Flight::route('GET /api/list', function() use ($url){
    $jsonResponse = file_get_contents($url);
    $response = json_decode($jsonResponse,true);
    echo Flight::json($response);
    die();
});

Flight::route('GET /api/converter/@from/@to/@price', function($from, $to, $price) use ($url){

    $validator = 0;

    $response = [
        'error' => true,
        'status_text' => 'Invalid parameters',
        'status_code' => 200,
        'data' => null
    ];

    if(!is_numeric($price))
    {
        $validator = 1;
    }

    if(!ctype_alpha($from) || !ctype_alpha($to))
    {
        $validator = 1;
    }

    if($validator)
    {
        echo Flight::json($response);
        die();
    }

    $from = strtoupper($from);
    $to = strtoupper($to);

    $jsonResponse = file_get_contents($url);
    $rates = json_decode($jsonResponse,  JSON_UNESCAPED_UNICODE);

    foreach ($rates['data'] as $rate)
    {
        if($rate['oznaka'] == $from)
        {
            $from = $rate;
        }
        if($rate['oznaka'] == $to)
        {
            $to = $rate;
        }
    }

    if(!is_array($to) || !is_array($from))
    {
        echo Flight::json($response);
        die();
    }

    $finallPrice = ( floatval($price) * floatval($from['sreden']) ) / floatval($to['sreden']);

    $response['error'] = false;
    $response['status_text'] = 'OK';
    $response['status_code'] = 200;
    $response['data'] = [
      'price' => $finallPrice
    ];

    echo Flight::json($response);
    die();
});

Flight::route('GET /api/history/@value', function($value){
    echo 'hello world!' . getenv('MAIN_API_PATH');
});

Flight::start();