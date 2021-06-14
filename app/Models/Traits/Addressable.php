<?php

namespace App\Models\Traits;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Addressable
{
    /**
     * Get the model's address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
