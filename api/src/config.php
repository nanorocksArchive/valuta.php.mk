<?php

/**
 * ENV INS
 */
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

/**
 * Set default configuration data
 */
ExchangeRate::$url = getenv('URL');
ExchangeRate::$apiEndpoints = getenv('API_CONTENT');
ExchangeRate::$customUrl =  getenv('MAIN_API_PATH');
ExchangeRate::$token =  getenv('SECRET_TOKEN');