<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller;

/**
 * Class RateController
 * @package App\Http\Controllers
 */
class RateController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $argc
     * @return mixed
     */
    public function get(Request $request, Response $response, $argc = [])
    {
        $jsonResponse=file_get_contents( env('PING_API'));
        return json_decode($jsonResponse,true);
    }
}
