<?php

namespace App\Actions\Auth;

use Illuminate\Contracts\Auth\StatefulGuard;

abstract class AuthAction
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create new authenticate user action instance.
     *
     * @param \Illuminate\Contracts\Auth\StatefulGuard $guard
     *
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }
}
