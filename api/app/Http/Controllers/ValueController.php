<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Laravel\Lumen\Routing\Controller;

class ValueController extends Controller
{
    
    public function history(Request $request, Response $response, $argc = [])
    {
        return 'value controller';
    }
}
