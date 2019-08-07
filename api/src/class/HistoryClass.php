<?php

class HistoryClass extends ExchangeRateClass
{

    public $validator;

    public function __construct(
        ExchangeRateHelper $v
    )
    {
        $this->validator = $v;
    }

    /**
     * Validate currency value
     *
     * @param $value
     * @param $data
     * @return int
     */
    public static function validateCurrencyValue($value, $data)
    {
        $validator = 0;

        if (is_numeric($value) || ctype_alnum($value)) {
            $validator = 1;
        }

        $value = strtoupper($value);
        foreach ($data as $rate) {
            if ($value == $rate['oznaka']) {
                $validator = 0;
                break;
            }
        }

        return $validator;
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