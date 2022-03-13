<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class WP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user == true && $user->role != 'wp') {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized.'
            ], Response::HTTP_UNAUTHORIZED);
        }
        if ($user == false) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is invalid.'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
