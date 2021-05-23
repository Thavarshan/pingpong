<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class AuthenticationTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testLoginScreenCanBeRendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testUsersCanAuthenticateUsingTheLoginScreen()
    {
        $user = create(User::class, [
            'email' => 'test.user@example.com',
            'password' => Hash::make('secretpassword'),
        ]);

        $response = $this->from('/login')->post('/login', $this->validParameters());

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function testUsersCanAuthenticateThroughJsonRequest()
    {
        $user = create(User::class, [
            'email' => 'test.user@example.com',
            'password' => Hash::make('secretpassword'),
        ]);

        $response = $this->postJson('/login', $this->validParameters());

        $this->assertAuthenticated();
        $response->assertStatus(200);
    }

    public function testValidEmailIsRequired()
    {
        create(User::class, [
            'email' => 'test.user@example.com',
            'password' => Hash::make('secretpassword'),
        ]);

        $response = $this->post('/login', $this->validParameters([
            'email' => '',
        ]));

        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    public function testUsersCanNotAuthenticateWithInvalidPassword()
    {
        $user = create(User::class);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    /**
     * Provide only the necessary paramertes for a POST-able type request.
     *
     * @param array $overrides
     *
     * @return array
     */
    public function validParameters(array $overrides = []): array
    {
        return array_merge([
            'email' => 'test.user@example.com',
            'password' => 'secretpassword',
        ], $overrides);
    }
}
