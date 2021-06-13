<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase;

    public function testOtherBrowserSessionsCanBeLoggedOut()
    {
        $this->signIn($user = create(User::class));

        $response = $this->delete('/user/other-browser-sessions', [
            'password' => 'password',
        ]);

        $response->assertSessionHasNoErrors();
    }
}
