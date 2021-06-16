<?php

namespace App\Http\Responses;

use Emberfuse\Scorch\Http\Responses\Response;
use Illuminate\Contracts\Support\Responsable;

class ContactAddressResponse extends Response implements Responsable
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return $request->expectsJson()
            ? $this->json($this->content)
            : $this->back(303);
    }
}
