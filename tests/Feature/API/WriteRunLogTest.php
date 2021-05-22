<?php

namespace Tests\Feature\API;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WriteRunLogTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthorizedAppRunCanBeLogged()
    {
        $user = create(User::class);
        $token = $user->createToken($name = 'Birthdays App', ['create']);

        $response = $this->postJson('/api/logs', [
            'app_name' => $name,
            'init_time' => Carbon::now(),
            'status' => true,
            'contacts' => [],
        ], [
            'Authorization' => "Bearer {$token->plainTextToken}",
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('runs', ['app_name' => $name]);
    }

    public function testUnAuthorizedAppRunCannotBeLogged()
    {
        $token = Str::random();

        $response = $this->postJson('/api/logs', [
            'app_name' => 'BirthdaysApp',
            'init_time' => Carbon::now(),
            'status' => true,
            'contacts' => [],
        ], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(401);
    }
}
