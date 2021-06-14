<?php

namespace App\Actions\Contacts;

use App\Models\Contact;
use Emberfuse\Scorch\Support\Traits\Fillable;

class UpdateContactInformation
{
    use Fillable;

    /**
     * Update the details of the given contact.
     *
     * @param \App\Models\Contact $contact
     * @param array               $data
     *
     * @return void
     */
    public function update(Contact $contact, array $data): void
    {
        $contact->update($this->filterFillable($data, Contact::class));
    }
}
