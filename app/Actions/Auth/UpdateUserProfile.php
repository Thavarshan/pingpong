<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cratespace\Sentinel\Contracts\Actions\UpdatesUserProfiles;

class UpdateUserProfile implements UpdatesUserProfiles
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param \App\Models\User $user
     * @param array            $data
     *
     * @return void
     */
    public function update(User $user, array $data, ?array $options = null): void
    {
        if (isset($data['photo'])) {
            $user->updateProfilePhoto($data['photo']);
        }

        if ($data['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateInformation($user, $data, true);

            $user->sendEmailVerificationNotification();
        } else {
            $this->updateInformation($user, $data, false);
        }
    }

    /**
     * Update the given user's profile information.
     *
     * @param \App\Models\User $user
     * @param array            $data
     * @param bool             $verified
     *
     * @return void
     */
    protected function updateInformation(User $user, array $data, bool $verified = true): void
    {
        $user->forceFill(array_merge([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
        ], $verified ? ['email_verified_at' => null] : []))->save();
    }
}
