<?php

namespace App\Http\Requests;

use Cratespace\Sentinel\Http\Requests\Request;

class RunRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->user()->currentAccessToken()->name === $this->app_name) {
            return $this->user()->tokenCan('create');
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getRulesFor('run');
    }
}
