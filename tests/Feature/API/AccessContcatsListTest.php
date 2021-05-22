<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccessContcatsListTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthorizedAppsCanAccessContactsList()
    {
        $user = create(User::class);
        $token = $user->createToken('Birthdays App', ['read']);

        $response = $this->getJson('/api/contacts', [
            'Authorization' => "Bearer {$token->plainTextToken}",
        ]);

        $response->assertStatus(200);
    }

    public function testUnAuthorizedAppsCannotAccessContactsList()
    {
        $response = $this->getJson('/api/contacts');

        $response->assertStatus(401);
    }
}
