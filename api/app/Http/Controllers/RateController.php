<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \GuzzleHttp\Exception\GuzzleException;
use \GuzzleHttp\Client;
use Laravel\Lumen\Routing\Controller;

class RateController extends Controller
{
    protected $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->$guzzle = $guzzle;
    }

    public function get(Request $request, Response $response, $argc = [])
    {
 
        //$data = $this->guzzle->request('GET', env('PING_API'), []);
        //dd($data);
        //return $data;
    }
}
