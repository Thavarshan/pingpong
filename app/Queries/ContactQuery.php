<?php

namespace App\Queries;

use App\Models\Contact;
use Cratespace\Preflight\Queries\Query;
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
     * Get contacts belonging to the user.
     *
     * @param mixed $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function forUser($user): Builder
    {
        return $this->query()
            ->where('user_id', $user->id)
            ->orderByRaw('DATE_FORMAT(birthday, "%m-%d")');
    }
}
