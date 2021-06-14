<?php

namespace App\Actions\Contacts;

use App\Models\Contact;
use InvalidArgumentException;
use Emberfuse\Scorch\Support\Traits\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Emberfuse\Scorch\Contracts\Actions\CreatesNewResources;

class CreateNewContact implements CreatesNewResources
{
    use Fillable;

    /**
     * Create a new resource type.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return mixed
     */
    public function create(array $data, ?array $options = null)
    {
        if (! isset($options['user'])) {
            throw new InvalidArgumentException('Authenticated user required.');
        }

        return tap($options['user']->contacts(), function (HasMany $contacts) use ($data) {
            $contacts->create($this->filterFillable($data, Contact::class));
        });
    }
}
