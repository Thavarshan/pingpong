<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Contact $contact
     *
     * @return mixed
     */
    public function manage(User $user, Contact $contact)
    {
        return $user->contacts->contains($contact);
    }
}
