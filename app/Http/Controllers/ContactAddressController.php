<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactAddressRequest;
use App\Http\Responses\ContactAddressResponse;
use App\Actions\Contacts\UpdateContactAddressInformation;

class ContactAddressController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact      $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        ContactAddressRequest $request,
        Contact $contact,
        UpdateContactAddressInformation $manager
    ) {
        $manager->manage($contact, $request->validated());

        return ContactAddressResponse::dispatch($contact);
    }
}
