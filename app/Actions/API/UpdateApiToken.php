<?php

namespace App\Actions\API;

use App\Models\User;
use Emberfuse\Blaze\API\Permission;
use Emberfuse\Blaze\Contracts\Actions\UpdatesApiTokens;

class UpdateApiToken implements UpdatesApiTokens
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
        $token = $user->tokens()
            ->where('id', $data['token_id'])
            ->firstOrFail();

        $token->forceFill([
            'abilities' => Permission::validPermissions(
                $data['permissions'] ?? []
            ),
        ])->save();
    }
}
