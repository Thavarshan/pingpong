<?php

namespace App\Actions\API;

use InvalidArgumentException;
use Cratespace\Preflight\API\Permission;
use Cratespace\Preflight\Contracts\API\CreatesNewApiTokens;

class CreateNewApiToken implements CreatesNewApiTokens
{
    /**
     * Create a new resource type.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data, ?array $options = null)
    {
        $token = optional($options['user'])->createToken(
            $data['name'], Permission::validPermissions($data['permissions'] ?? [])
        );

        if (! is_null($token)) {
            return $token;
        }

        throw new InvalidArgumentException('User details not available');
    }
}
