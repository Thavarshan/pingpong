<?php

namespace App\Actions\Contacts;

use App\Models\Contact;

class UpdateContactAddressInformation
{
    /**
     * Manage contact address details.
     *
     * @param \App\Models\Contact $contact
     * @param array               $data
     *
     * @return void
     */
    public function manage(Contact $contact, array $data): void
    {
        $contact->address()->update($data);
    }
}
