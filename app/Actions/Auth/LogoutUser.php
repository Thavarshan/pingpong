<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Cratespace\Sentinel\Contracts\Actions\LogsoutUsers;

class LogoutUser extends AuthAction implements LogsoutUsers
{
    /**
     * Logout currently authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function logout(Request $request): void
    {
        $this->guard->logout();

        if ($request->hasSession()) {
            tap($request->session(), function (Session $session): void {
                $session->invalidate();

                $session->regenerateToken();
            });
        }
    }
}
