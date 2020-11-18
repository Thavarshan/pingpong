<?php

namespace Tests\Unit\Middleware;

use Tests\TestCase;
use App\Models\Token;
use Illuminate\Support\Str;

class TrustedAppsTest extends TestCase
{
    /** @test */
    public function authenticates_bearer_token()
    {
        $this->withoutExceptionHandling();

        $token = Token::create([
            'token' => $tokenString = Str::random(21),
        ]);

        $response = $this->get('/api/ping', ['Authorization' => 'Bearer ' . $tokenString]);

        $response->assertStatus(200);
        $this->assertEquals('ping', $response->getContent());
    }
}
