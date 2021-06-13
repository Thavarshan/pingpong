<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Emberfuse\Scorch\Scorch\Config;
use Emberfuse\Scorch\Contracts\Actions\AuthenticatesUsers;

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
