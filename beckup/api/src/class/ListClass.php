<?php

class ListClass extends ExchangeRateHelper
{
    /**
     * List all exchange rats
     */
    public function list()
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

        $validData = self::getDataFromUrl($response);

        if(!$validData)
        {
            $response = self::prepareResponse(true, 'Internal server error', 500);
        }

        return Flight::json($response);
    }

}