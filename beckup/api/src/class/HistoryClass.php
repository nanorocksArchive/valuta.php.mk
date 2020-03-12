<?php

class HistoryClass extends ExchangeRateHelper
{

    /**
     * History of 15 days ago
     *
     * @param $value
     */
    public static function history($value)
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

        $haveData = self::getDataFromUrl($rates);
        if (!$haveData || $rates == null || !isset($rates['data'])) {
            $response = self::prepareResponse(true, 'Internal server error', 500);
            return Flight::json($response);
        }

        $validator = self::validateCurrencyValue($value, $rates['data']);
        if (!$validator) {
            $response = self::prepareResponse(true, 'Invalid parameters', 400);
            return Flight::json($response);
        }

        $value = strtoupper($value);

        // last 15 days - get current date
        $dateNow = date('Y-m-d');
        // Implement caching if date not changed
        Flight::lastModified($dateNow);

        $responseData = [];

        for ($i = 0; $i < 15; $i++) {
            $dateYesterday = date('Y-m-d', strtotime($dateNow . ' -' . $i . ' day'));
            $customUrl = self::$customUrl . $dateYesterday . '?token=' . self::$token;

            $validData = self::getDataFromUrl($rates, $customUrl);
            if (!$validData) {
                $response = self::prepareResponse(true, 'Internal server error', 500);
                return Flight::json($response);
            }

            $data = $rates['data'];
            $statusCode = $rates['status_code'];

            if ($statusCode != 200) {
                $response = self::prepareResponse(true, 'Service Unavailable', 503);
                return Flight::json($response);
            }

            // status code == 200
            self::prepareResponseHistory($data, $value, $responseData);
        }

        return Flight::json($responseData);
    }

}