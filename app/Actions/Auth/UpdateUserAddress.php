<?php

namespace App\Actions\Auth;

use App\Models\User;
use Cratespace\Sentinel\Contracts\Actions\UpdateUserInformation;

class UpdateUserAddress implements UpdateUserInformation
{
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
        $user->forceFill([
            'address' => [
                'line1' => $data['line1'],
                'line2' => $data['line2'] ?? null,
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'postal_code' => $data['postal_code'],
            ],
        ])->save();
    }
}
