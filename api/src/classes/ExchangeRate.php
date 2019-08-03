<?php


class ExchangeRate extends ValidateExchangeRate
{

    public static $url;

    public static $apiEndpoints;

    public static $customUrl;

    public static $token;

    /**
     * On load static content
     */
    public static function onload()
    {
        echo "<pre>" . self::$apiEndpoints . "</pre>";
        die();
    }

    /**
     * List add exchange rats
     */
    public static function list()
    {

        $url = self::$url;
        try {

            $jsonResponse = file_get_contents($url);
            $response = json_decode($jsonResponse, true);

        } catch (Exception $e) {
            $response = [
                'error' => true,
                'status_text' => 'Internal server error',
                'status_code' => 500,
                'data' => null
            ];
        }

        echo Flight::json($response);
        die();
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

    /**
     * History of 15 days behind
     *
     * @param $value
     */
    public static function history($value)
    {
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

        $validator = self::validateCurrencyValue($value, $rates['data']);

        if ($validator) {
            $response = [
                'error' => true,
                'status_text' => 'Invalid parameters',
                'status_code' => 200,
                'data' => null
            ];

            echo Flight::json($response);
            die();
        }

        $value = strtoupper($value);

        // last 15 days
        $dateNow = date('Y-m-d');

        // Implement caching if date not change
        Flight::lastModified($dateNow);

        $responseData = [];

        for ($i = 0; $i < 15; $i++) {
            $dateBehind = date('Y-m-d', strtotime($dateNow . ' -' . $i . ' day'));
            $customUrl = self::$customUrl . $dateBehind . '?token=' . self::$token;

            try {

                $jsonResponse = file_get_contents($customUrl);
                $rates = json_decode($jsonResponse, JSON_UNESCAPED_UNICODE);
                $data = $rates['data'];
                $statusCode = $rates['status_code'];

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

            if ($statusCode != 200) {
                $response = [
                    'error' => true,
                    'status_text' => 'Service Unavailable',
                    'status_code' => 503,
                    'data' => null
                ];

                echo Flight::json($response);
                die();
            }

            // status code == 200
            foreach ($data as $rate) {

                if ($rate['oznaka'] == $value) {
                    $responseData[] = [
                        'datum' => $rate['datum'],
                        'kupoven' => $rate['kupoven'],
                        'sreden' => $rate['sreden'],
                        'prodazen' => $rate['prodazen'],
                        'oznaka' => $rate['oznaka']
                    ];
                    break;
                }
            }

        }

        echo Flight::json($responseData);
        die();
    }

}