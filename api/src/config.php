<?php

/**
 * ENV INS
 */
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

/**
 * Set default configuration data
 */
ExchangeRateHelper::$url = getenv('URL');
ExchangeRateHelper::$apiEndpoints = getenv('API_CONTENT');
ExchangeRateHelper::$customUrl =  getenv('MAIN_API_PATH');
ExchangeRateHelper::$token =  getenv('SECRET_TOKEN');


/**
 * Set flight template folder path
 */

Flight::set('flight.views.path', __DIR__ . '/template');

