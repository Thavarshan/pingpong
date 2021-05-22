<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Cratespace\Sentinel\Sentinel\Config;
use Cratespace\Sentinel\Contracts\Actions\AuthenticatesUsers;

class AuthenticateUser extends AuthAction implements AuthenticatesUsers
{
    /**
     * Authenticate user making current request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function authenticate(Request $request): bool
    {
        return $this->guard->attempt(
            $request->only(Config::username(), 'password'),
            $request->filled('remember')
        );
    }
}
