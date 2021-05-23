<?php

namespace App\Actions\Auth;

use Closure;
use Illuminate\Auth\Events\PasswordReset;
use App\Actions\Auth\Traits\PasswordUpdater;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Cratespace\Sentinel\Contracts\Actions\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordUpdater;

    /**
     * The password broker implementation.
     *
     * @var \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected $broker;

    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create new instance of user password resetor.
     *
     * @param \Illuminate\Contracts\Auth\PasswordBroker $broker
     * @param \Illuminate\Contracts\Auth\StatefulGuard  $guard
     *
     * @return void
     */
    public function __construct(PasswordBroker $broker, StatefulGuard $guard)
    {
        $this->broker = $broker;
        $this->guard = $guard;
    }

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function reset(array $data)
    {
        return $this->broker->reset(
            $data, $this->resetPasswordCallback($data['password'])
        );
    }

    /**
     * Get callback used to actually reset the given user's password.
     *
     * @param string $password
     *
     * @return \Closure
     */
    protected function resetPasswordCallback(string $password): Closure
    {
        return function ($user) use ($password) {
            $this->updatePassword($user, $password);

            event(new PasswordReset($user));
        };
    }
}
