<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Responses\ContactResponse;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::where('user_id', $request->user()->id)
            ->orderByRaw('DATE_FORMAT(birthday, "%m-%d")')
            ->paginate();

        if ($request->expectsJson()) {
            return response()->json($contacts);
        }

        return Inertia::render('Contacts/Index', compact('contacts'));
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
    public function store(ContactRequest $request)
    {
        $contact = $request->user()
            ->contacts()
            ->create($request->validated());

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
        return Inertia::render('Contacts/Show');
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
        return Inertia::render('Contacts/Edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact      $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return ContactResponse::dispatch($contact->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return ContactResponse::dispatch();
    }
}
