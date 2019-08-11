<?php

class ListClass extends ExchangeRateHelper
{
    /**
     * List add exchange rats
     */
    public function list()
    {
        $validData = self::getDataFromUrl($response);

        if(!$validData)
        {
            $response = self::prepareResponse(true, 'Internal server error', 500);
        }

        return Flight::json($response);
    }

}