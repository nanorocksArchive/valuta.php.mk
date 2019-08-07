<?php

class ListClass extends ExchangeRateClass
{

    public $validator;

    public function __construct(
        ExchangeRateHelper $v
    )
    {
        $this->validator = $v;
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

}