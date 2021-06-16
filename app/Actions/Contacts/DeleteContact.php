<?php

namespace App\Actions\Contacts;

use App\Models\Contact;

class DeleteContact
{
    /**
     * Delete given contact.
     *
     * @param \App\Models\Contact $contact
     *
     * @return void
     */
    public function delete(Contact $contact): void
    {
        tap($contact, fn (Contact $contact) => $contact->address()->delete())->delete();
    }
}
