<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;
use App\Queries\ContactQuery;
use App\Filters\ContactFilter;
use App\Http\Requests\ContactRequest;
use App\Actions\Contacts\DeleteContact;
use App\Http\Responses\ContactResponse;
use App\Actions\Contacts\CreateNewContact;
use App\Actions\Contacts\UpdateContactInformation;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Queries\ContactQuery  $query
     * @param \App\Filters\ContactFilter $filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactQuery $query, ContactFilter $filters)
    {
        $contacts = $query->personal($filters);

        if ($this->resolve('request')->expectsJson()) {
            return $this->response()->json($contacts->get());
        }

        return Inertia::render('Contacts/Index', [
            'contacts' => $contacts->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Contacts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request, CreateNewContact $creator)
    {
        $contact = $creator->create(
            $request->validated(),
            ['user' => $request->user()]
        );

        return ContactResponse::dispatch($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return Inertia::render('Contacts/Edit', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return Inertia::render('Contacts/Edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact      $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        ContactRequest $request,
        Contact $contact,
        UpdateContactInformation $updater
    ) {
        $updater->update($contact, $request->validated());

        return ContactResponse::dispatch($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact, DeleteContact $deleter)
    {
        $deleter->delete($contact);

        return ContactResponse::dispatch();
    }
}
