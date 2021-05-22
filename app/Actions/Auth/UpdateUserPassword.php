<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Actions\Auth\Traits\PasswordUpdater;
use Cratespace\Sentinel\Contracts\Actions\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordUpdater;

    /**
     * Validate and update the given user's profile information.
     *
     * @param \App\Models\User $user
     * @param array            $data
     * @param array|null       $options
     *
     * @return void
     */
    public function update(User $user, array $data, ?array $options = null): void
    {
        $this->updatePassword($user, $data['password'], true);
    }
}
