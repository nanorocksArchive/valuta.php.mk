<?php

require_once __DIR__ . './../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

Flight::route('GET /', function(){
    echo 'hello world!' . getenv('MAIN_API_PATH');
});

Flight::route('GET /list', function(){
    echo 'hello world!' . getenv('MAIN_API_PATH');
});

Flight::route('GET /converter/@from/@to/@price', function($from, $to, $price){
    echo 'hello world!' . getenv('MAIN_API_PATH');
});

Flight::route('GET /history/@value', function($value){
    echo 'hello world!' . getenv('MAIN_API_PATH');
});

Flight::start();