<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Emberfuse\Blaze\Testing\Contracts\Postable;

class CreateApiTokenTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testApiTokensCanBeCreated()
    {
        $this->signIn($user = create(User::class));

        $response = $this->post('/user/api-tokens', $this->validParameters());

        $response->assertStatus(303);
        $response->assertSessionHasNoErrors();
        $this->assertCount(1, $user->fresh()->tokens);
        $this->assertEquals('Test Token', $user->fresh()->tokens->first()->name);
        $this->assertFalse($user->fresh()->tokens->first()->can('read'));
        $this->assertTrue($user->fresh()->tokens->first()->can('delete'));
    }

    public function testValidNameIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->post('/user/api-tokens', $this->validParameters([
            'name' => '',
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
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
            'name' => 'Test Token',
            'permissions' => [
                'delete',
                'missing-permission',
            ],
        ], $overrides);
    }
}
