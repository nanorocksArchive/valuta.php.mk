<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller;

/**
 * Class ConverterController
 * @package App\Http\Controllers
 */
class ConverterController extends Controller
{
    public function values(Request $request, Response $response, $from, $to, $value)
    {
        // validate params
        $validator = Validator::make([
            'from' => $from,
            'to' => $to,
            'value' => $value
        ], [
            'from' => 'required|alpha',
            'to' => 'required|alpha',
            'value' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return self::prepareResponse(true, $validator->errors(), 200, null);
        }

        $jsonResponse=file_get_contents( env('PING_API'));
        $rates = json_decode($jsonResponse,true);

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

                $finalPrice = (floatval($value) * floatval($from['sreden'])) / floatval($to['sreden']);
            }

            // From here we have denar
            // If value is valid - MKD for $to or $from
            if ($whoIsDenar == 'to') {
                $finalPrice = (floatval($value) * floatval($from['sreden']));
            }
            if ($whoIsDenar == 'from') {
                $finalPrice = (floatval($value) / floatval($to['sreden']));
            }
        }
        catch (\Exception $e)
        {
            return self::prepareResponse(true, 'Invalid query params', 400);
        }

        return self::prepareResponse(false, 'OK', 200, ['price' => $finalPrice]);
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
            return $denar;
        } else if (is_string($from) && strtoupper($from) == 'MKD') {
            $denar = true;
            $whoIsDenar = 'from';
            return $denar;
        }

        return $denar;
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
}
