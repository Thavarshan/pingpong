<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Emberfuse\Blaze\Testing\Contracts\Postable;

class ApiTokenPermissionsTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testApiTokenPermissionsCanBeUpdated()
    {
        $this->signIn($user = create(User::class));

        $token = $user->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        $response = $this->put(
            "/user/api-tokens/{$token->id}",
            $this->validParameters(['name' => $token->name])
        );

        $response->assertStatus(303);
        $response->assertSessionHasNoErrors();
        $this->assertTrue($user->fresh()->tokens->first()->can('delete'));
        $this->assertFalse($user->fresh()->tokens->first()->can('read'));
        $this->assertFalse($user->fresh()->tokens->first()->can('missing-permission'));
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
