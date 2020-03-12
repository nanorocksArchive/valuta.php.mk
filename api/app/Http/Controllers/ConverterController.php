<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Laravel\Lumen\Routing\Controller;

class ConvertController extends Controller
{
    public function values(Request $request, Response $response, $argc = [])
    {
        return "Converter controller";
    }
}
