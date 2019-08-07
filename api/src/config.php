<?php

/**
 * ENV INS
 */
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

/**
 * Set default configuration data
 */
ExchangeRateClass::$url = getenv('URL');
ExchangeRateClass::$apiEndpoints = getenv('API_CONTENT');
ExchangeRateClass::$customUrl =  getenv('MAIN_API_PATH');
ExchangeRateClass::$token =  getenv('SECRET_TOKEN');


/**
 * Set flight template folder path
 */

Flight::set('flight.views.path', __DIR__ . '/template');

