<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the token from the request headers
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        // Check if the token is present
        if (!$token) {
            return response()->json(['error' => 'Unauthorized, token missing'], 401);
        }

        // Remove 'Bearer ' prefix if it's there
        // $token = str_replace('Bearer ', '', $token);
        $staticToken = "dGhpcyBpcyBhIHJhbmRvbSBhcGkgdG9rZW4gZm9yIHlvdXIgc3lzdGVtLg==";
        // Attempt to authenticate with the token (e.g., using Passport, Sanctum, or custom logic)
        if ($token != $staticToken) {
            return response()->json(['error' => 'Unauthorized, invalid token'], 401);
        }
        // Proceed with the request if token is valid
        return $next($request);
    }
}
