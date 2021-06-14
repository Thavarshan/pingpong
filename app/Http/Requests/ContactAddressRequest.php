<?php

namespace App\Http\Requests;

use Emberfuse\Scorch\Http\Requests\Request;

class ContactAddressRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->isAllowed('manage', $this->route('contact'), false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getRulesFor('address');
    }
}
