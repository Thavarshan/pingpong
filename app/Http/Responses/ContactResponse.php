<?php

namespace App\Http\Responses;

use Emberfuse\Scorch\Http\Responses\Response;
use Illuminate\Contracts\Support\Responsable;

class ContactResponse extends Response implements Responsable
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
        if ($request->expectsJson()) {
            return $this->json($this->content);
        }

        return $request->method() === 'DELETE'
            ? $this->redirectTo('/contacts', 303)
            : $this->redirectTo($this->content->path, 303)->banner(__('Contact saved.'));
    }
}
