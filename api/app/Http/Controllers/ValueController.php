<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Laravel\Lumen\Routing\Controller;

class ValueController extends Controller
{
    public static $customUrl;

    public static $token;

    public function history(Request $request, Response $response, $argc = [], $value)
    {
        self::$customUrl =  getenv('PATH_API');
        self::$token =  getenv('TOKEN_API');

        $value = strtoupper($value);
        // last 15 days - get current date
        $dateNow = date('Y-m-d');
        $responseData = [];

        for ($i = 0; $i < 15; $i++) {
            $dateYesterday = date('Y-m-d', strtotime($dateNow . ' -' . $i . ' day'));
            $customUrl = self::$customUrl . $dateYesterday . '?token=' . self::$token;

            $validData = self::getDataFromUrl($rates, $customUrl);
            if (!$validData) {
                return self::prepareResponse(true, 'Internal server error', 500);
            }

            $data = $rates['data'];
            $statusCode = $rates['status_code'];

            if ($statusCode != 200) {
                return self::prepareResponse(true, 'Service Unavailable', 503);
            }

            // status code == 200
            self::prepareResponseHistory($data, $value, $responseData);
        }

        return $responseData;
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
}
