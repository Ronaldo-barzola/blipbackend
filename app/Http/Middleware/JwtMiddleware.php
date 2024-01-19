<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Http\Controllers\Controller;

class JwtMiddleware extends BaseMiddleware
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
        try {

            // $user = JWTAuth::parseToken()->authenticate();
            $user = 242;

        } catch (Exception $e) {
            

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                // return response()->json(['status' => 'Token is Invalid']);
                return Controller::errorLanguage('-1001');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                return Controller::errorLanguage('-1002');

            } else {

                return Controller::errorLanguage('-1003');
            }
        }
        return $next($request);
    }

}