<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Token;
use Illuminate\Http\Request;

class IsTrustedApp
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Token::whereToken($request->bearerToken())->exists()) {
            return $next($request);
        }

        return response(['message' => 'App not authorized.'], 401);
    }
}
