<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testApiTokensCanBeDeleted()
    {
        $this->signIn($user = create(User::class));

        $token = $user->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        $response = $this->delete('/user/api-tokens/' . $token->id);

        $this->assertCount(0, $user->fresh()->tokens);
    }
}
