<?php

class ConverterClass extends ExchangeRateClass
{

    public $helper;

    public function __construct(
        ExchangeRateHelper $h
    )
    {
        $this->helper = $h;
    }

    /**
     *
     * Validate request for converter
     *
     * @param $to
     * @param $from
     * @param $price
     * @return int
     */
    public static function validateConverter($to, $from, $price): int
    {
        $validator = 0;

        if (!is_numeric($price)) {
            $validator = 1;
        }

        if (!ctype_alpha($from) || !ctype_alpha($to)) {
            $validator = 1;
        }

        if ($from == $to) {
            $validator = 1;
        }

        return $validator;
    }


    /**
     * Convert price from from - to
     *
     * @param $from
     * @param $to
     * @param $price
     */
    public static function converter($from, $to, $price)
    {
        $response = [
            'error' => true,
            'status_text' => 'Invalid parameters',
            'status_code' => 200,
            'data' => null
        ];

        $validator = self::validateConverter($to, $from, $price);
        if ($validator) {
            echo Flight::json($response);
            die();
        }

        $from = strtoupper($from);
        $to = strtoupper($to);

        $url = self::$url;
        try {

            $jsonResponse = file_get_contents($url);
            $rates = json_decode($jsonResponse, JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {

            $response = [
                'error' => true,
                'status_text' => 'Internal server error',
                'status_code' => 500,
                'data' => null
            ];

            echo Flight::json($response);
            die();
        }

        foreach ($rates['data'] as $rate) {
            if ($rate['oznaka'] == $from) {
                $from = $rate;
            }
            if ($rate['oznaka'] == $to) {
                $to = $rate;
            }
        }

        $denar = 0;
        $finalPrice = 0;
        // FOR DENAR-VALUE ONLY
        if (is_string($to) && strtoupper($to) == 'MKD') {
            $finalPrice = (floatval($price) * floatval($from['sreden']));
            $denar = 1;
        } else if (is_string($from) && strtoupper($from) == 'MKD') {
            $finalPrice = (floatval($price) / floatval($to['sreden']));
            $denar = 1;
        }

        if (!$denar) {
            if (!is_array($to) || !is_array($from)) {
                echo Flight::json($response);
                die();
            }

            $finalPrice = (floatval($price) * floatval($from['sreden'])) / floatval($to['sreden']);
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
}