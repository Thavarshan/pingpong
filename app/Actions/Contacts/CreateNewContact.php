<?php

namespace App\Actions\Contacts;

use App\Models\User;
use App\Models\Contact;
use InvalidArgumentException;
use Illuminate\Auth\AuthenticationException;
use Emberfuse\Scorch\Support\Traits\Fillable;
use Emberfuse\Scorch\Contracts\Actions\CreatesNewResources;

class CreateNewContact implements CreatesNewResources
{
    use Fillable;

    /**
     * Create a new resource type.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return mixed
     */
    public function create(array $data, ?array $options = null)
    {
        if (! isset($options['user'])) {
            throw new InvalidArgumentException('Authenticated user required.');
        }

        $user = $this->getUser($options['user']);

        return with($user->contacts(), function ($contacts) use ($data) {
            $contact = $contacts->create(
                $this->filterFillable($data, Contact::class)
            );

            $contact->address()->create([]);

            return $contact;
        });
    }

    /**
     * Get the currently authenticated user.
     *
     * @param mixed $user
     *
     * @return \App\Models\User
     */
    protected function getUser($user): User
    {
        if (! $user instanceof User) {
            $user = User::findOrFail($user);
        }

        if (! $user->is(auth()->user())) {
            throw new AuthenticationException();
        }

        return $user;
    }
}
