<?php

namespace App\Queries;

use App\Models\Contact;
use App\Filters\ContactFilter;
use Emberfuse\Blaze\Queries\Query;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ContactQuery extends Query
{
    /**
     * Instance of model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Contact::class;

    /**
     * Get all contacts that belongs to the authenticated user.
     *
     * @param \App\Filters\ContactFilter $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function personal(ContactFilter $filters): Builder
    {
        return $this->query()
            ->whereUserId(auth()->id())
            ->filter($filters)
            ->orderBy('name');
    }
}
