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


class Validator{

    /**
     * Validate request for converter
     */
    public static function validateConverter($to, $from, $price) : int
    {
        $validator = 0;

        if(!is_numeric($price))
        {
            $validator = 1;
        }

        if(!ctype_alpha($from) || !ctype_alpha($to))
        {
            $validator = 1;
        }

        if($from == $to)
        {
            $validator = 1;
        }

        return $validator;
    }

}

/**
 * Main class
 */

class ExchangeRate extends Validator {

    public static $url;

    public static $apiEndpoints;


    public static function  onload()
    {
        echo "<pre>" . self::$apiEndpoints . "</pre>";
        die();
    }


    public static function list()
    {
        $url = self::$url;
        $jsonResponse = file_get_contents($url);
        $response = json_decode($jsonResponse,true);
        echo Flight::json($response);
        die();
    }


    public static function converter($from, $to, $price)
    {

        $response = [
            'error' => true,
            'status_text' => 'Invalid parameters',
            'status_code' => 200,
            'data' => null
        ];

        $validator = self::validateConverter($to, $from, $price);
        if($validator)
        {
            echo Flight::json($response);
            die();
        }

        $from = strtoupper($from);
        $to = strtoupper($to);

        $url = self::$url;
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

        $denar = 0;
        $finalPrice = 0;
        // FOR DENAR-VALUE ONLY
        if(is_string($to) && strtoupper($to) == 'MKD')
        {
            $finalPrice = (floatval($price) * floatval($from['sreden']));
            $denar = 1;
        }
        else if(is_string($from) && strtoupper($from) == 'MKD')
        {
            $finalPrice = (floatval($price) / floatval($to['sreden']));
            $denar = 1;
        }

        if (!$denar)
        {
            if(!is_array($to) || !is_array($from))
            {
                echo Flight::json($response);
                die();
            }

            $finalPrice = ( floatval($price) * floatval($from['sreden']) ) / floatval($to['sreden']);
        }

        $response['error'] = false;
        $response['status_text'] = 'OK';
        $response['status_code'] = 200;
        $response['data'] = [
            'price' => $finalPrice
        ];

        echo Flight::json($response);
        die();
    }


    public static function history($value)
    {
        echo 'hello world!' . getenv('MAIN_API_PATH');
    }

}

/**
 * Set default configuration data
 */
ExchangeRate::$url = getenv('URL');
ExchangeRate::$apiEndpoints = getenv('API_CONTENT');

/**
 * Routes
 */
Flight::route('GET /', ['ExchangeRate', 'onload']);

Flight::route('GET /api/list', ['ExchangeRate','list']);

Flight::route('GET /api/converter/@from/@to/@price', ['ExchangeRate', 'converter']);

Flight::route('GET /api/history/@value', ['ExchangeRate', 'history']);

/**
 * App Start
 */
Flight::start();