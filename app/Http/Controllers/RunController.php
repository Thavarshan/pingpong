<?php

namespace App\Http\Controllers;

use App\Models\Run;
use Inertia\Inertia;
use App\Models\Contact;
use App\Http\Requests\RunRequest;
use App\Http\Responses\RunResponse;

class RunController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RunRequest $request)
    {
        $run = $request->user()
            ->runs()
            ->create($request->validated());

        if (! $request->status) {
            return RunResponse::dispatch('Failed');
        }

        collect($request->contacts)->each(function ($contact) use ($run) {
            if ($contact = Contact::find($contact)) {
                $run->contacts()->save($contact);
            }
        });

        return RunResponse::dispatch('Logged');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Run $run
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Run $run)
    {
        return Inertia::render('Runs/Show', compact('run'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Run $run
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Run $run)
    {
        $run->delete();

        return $this->response()->back(303);
    }
}
