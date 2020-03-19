<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class KeyAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $keyAccess = $request->get('keyAccess');
         if (empty($keyAccess) ||  $keyAccess != env('APP_KEY'))
         {
             return response()->json([
                 'status' => 'Invalid access',
                 'code' => 401
             ], 401);
         }

        return $next($request);
    }
}
