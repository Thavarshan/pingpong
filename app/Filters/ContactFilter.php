<?php

namespace App\Filters;

use Carbon\Carbon;
use Emberfuse\Blaze\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ContactFilter extends Filter
{
    /**
     * Attributes to filters from.
     *
     * @var array
     */
    protected $filters = ['birthdays'];

    /**
     * Filter contacts by birthday today.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function birthdays(): Builder
    {
        return $this->builder
            ->whereMonth('birthday', '=', Carbon::today()->format('m'))
            ->whereDay('birthday', '=', Carbon::today()->format('d'));
    }
}
