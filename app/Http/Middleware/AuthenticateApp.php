<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateApp
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
        if ($this->appIsRegistered($request)) {
            return $next($request);
        }

        return response(['message' => 'App not authorized.'], 401);
    }

    /**
     * Determine if the app requesting to be served is registered.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function appIsRegistered(Request $request): bool
    {
        return (bool) Hash::check(
            $request->bearerToken(),
            $this->getAppToken($request->header('X-App-Name'))
        );
    }

    /**
     * Get token of app requesting to be served.
     *
     * @param string $name
     *
     * @return string|null
     */
    protected function getAppToken(string $name)
    {
        return optional(
            Token::whereName($name)->first(),
            fn ($app) => $app->token
        );
    }
}
