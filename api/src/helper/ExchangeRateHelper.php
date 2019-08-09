<?php


class ExchangeRateClass
{

    public static $url;

    public static $apiEndpoints;

    public static $customUrl;

    public static $token;

    /**
     * Prepare response to return
     * @param $error
     * @param $statusText
     * @param $statusCode
     * @param null $data
     * @return array
     */
    public static function prepareResponse($error, $statusText, $statusCode, $data = null)
    {
        return $response = [
            'error' => $error,
            'status_text' => $statusText,
            'status_code' => $statusCode,
            'data' => $data
        ];
    }

    /**
     * Validate request for converter
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
     * Set data and return bool
     * @param $rates
     * @param null $newUrl
     * @return bool
     */
    public static function getDataFromUrl(&$rates, $newUrl = null)
    {
        try {
            $url = ($newUrl != null) ? $newUrl : self::$url;
            $jsonResponse = file_get_contents($url);
            $rates = json_decode($jsonResponse, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * Is value denar and it's MKD
     * @param $to
     * @param $from
     * @param $whoIsDenar
     * @return bool
     */
    public static function isValueDenar($to, $from, &$whoIsDenar)
    {
        $denar = false;
        if (is_string($to) && strtoupper($to) == 'MKD') {
            $denar = true;
            $whoIsDenar = 'to';
        } else if (is_string($from) && strtoupper($from) == 'MKD') {
            $denar = true;
            $whoIsDenar = 'from';
        }

        return $denar;
    }

    /**
     * Find rating for $to and $from - pass by reference
     * @param $to
     * @param $from
     * @param $rates
     */
    public static function findRating(&$to, &$from, $rates)
    {
        foreach ($rates['data'] as $rate) {
            if ($rate['oznaka'] == $from) {
                $from = $rate;
            }
            if ($rate['oznaka'] == $to) {
                $to = $rate;
            }
        }
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
        if (isset($value) && !ctype_alpha($value)) {
            return true;
        }

        $value = strtoupper($value);
        foreach ($data as $rate) {
            if ($value == $rate['oznaka']) {
                return false;
            }
        }

        return true;
    }

    /**
     * Prepare response for history
     * @param $data
     * @param $value
     * @param $responseData
     */
    public static function prepareResponseHistory($data, $value, &$responseData)
    {
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

}