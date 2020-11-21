<?php

namespace Tests\Unit\Middleware;

use Tests\TestCase;
use App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TrustedAppsTest extends TestCase
{
    /** @test */
    public function authenticates_bearer_token()
    {
        $this->withoutExceptionHandling();

        $tokenString = Str::random(21);

        $token = Token::create([
            'name' => 'ext-app',
            'token' => Hash::make($tokenString),
        ]);

        $response = $this->get('/api/ping', [
            'Authorization' => 'Bearer ' . $tokenString,
            'X-App-Name' => 'ext-app',
        ]);

        $response->assertStatus(200);
        $this->assertEquals('ping', $response->getContent());
    }
}
