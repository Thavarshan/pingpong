<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class ProfileInformationTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testProfileInformationCanBeUpdated()
    {
        $this->signIn($user = create(User::class));

        $response = $this->put('/user/profile', $this->validParameters());

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }

    public function testProfileInformationCanBeUpdatedThroughJsonRequest()
    {
        $this->signIn($user = create(User::class));

        $response = $this->putJson('/user/profile', $this->validParameters());

        $response->assertStatus(204);
        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }

    public function testValidNameIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put('/user/profile', $this->validParameters([
            'name' => '',
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateProfileInformation', 'name');
    }

    public function testValidUsernameIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put('/user/profile', $this->validParameters([
            'username' => '',
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateProfileInformation', 'username');
    }

    public function testValidEmailIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put('/user/profile', $this->validParameters([
            'email' => '',
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateProfileInformation', 'email');
    }

    public function testValidPhoneIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put('/user/profile', $this->validParameters([
            'phone' => '',
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateProfileInformation', 'phone');
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
            'name' => 'Test Name',
            'username' => 'TestUserName',
            'email' => 'test@example.com',
            'phone' => '0712345678',
        ], $overrides);
    }
}
