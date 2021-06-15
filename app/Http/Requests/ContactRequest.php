<?php

namespace App\Http\Requests;

use Emberfuse\Scorch\Http\Requests\Request;

class ContactRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->method() === 'PUT') {
            return $this->isAllowed('manage', $this->route('contact'), false);
        }

        return $this->isAuthenticated();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getRulesFor('contact');
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->setErrorBag('manageContactInformation');
    }
}
