<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the 'api-token' exists in the request header
        $apiToken = $request->header('api-token');
        if (!$apiToken || $apiToken !== env('API_TOKEN','123456')) {
            return response()->json([
                'message' => 'Unauthorized: Invalid API Token'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
