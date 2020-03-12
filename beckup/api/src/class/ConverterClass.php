<?php

class ConverterClass extends ExchangeRateHelper
{
    /**
     * Convert price from from - to
     *
     * @param $from
     * @param $to
     * @param $price
     */
    public static function converter($from, $to, $price)
    {
        $app = Flight::request()->data->getData()['app'];
        if(!isset($app))
        {
            $response = self::prepareResponse(true, 'Param app is missing', 422);
            return Flight::json($response);
        }

        if($app != ExchangeRateHelper::$appId)
        {
            $response = self::prepareResponse(true, 'Param app is not appropriate', 400);
            return Flight::json($response);
        }

        $response = self::prepareResponse(true, 'Invalid parameters', 200);
        $validator = self::validateConverter($to, $from, $price);
        if (!$validator) {
            return Flight::json($response);
        }

        $validData = self::getDataFromUrl($rates);
        if (!$validData) {
            $response = self::prepareResponse(true, 'Internal server error', 500);
            return Flight::json($response);
        }

        // if data is set and it's null or data it's not set in rating
        if (!isset($rates['data']) || (isset($rates['data']) && $rates['data'] == null)) {
            return Flight::json($response);
        }

        $from = strtoupper($from);
        $to = strtoupper($to);

        // if find rating, will return array for $to and $from
        self::findRating($to, $from, $rates);
        $isDenar = self::isValueDenar($to, $from, $whoIsDenar);
        $finalPrice = 0;
        try {
            if (!$isDenar) {
                // If value is not in ratings list - return only response
                if (!is_array($to) || !is_array($from)) {
                    return Flight::json($response);
                }

                $finalPrice = (floatval($price) * floatval($from['sreden'])) / floatval($to['sreden']);
            }

            // From here we have denar
            // If value is valid - MKD for $to or $from
            if ($whoIsDenar == 'to') {
                $finalPrice = (floatval($price) * floatval($from['sreden']));
            }
            if ($whoIsDenar == 'from') {
                $finalPrice = (floatval($price) / floatval($to['sreden']));
            }
        }catch (Exception $e)
        {
            $response = self::prepareResponse(true, 'Invalid query params', 400);
            return Flight::json($response);
        }
        $response = self::prepareResponse(false, 'OK', 200, ['price' => $finalPrice]);
        return Flight::json($response);
    }
}