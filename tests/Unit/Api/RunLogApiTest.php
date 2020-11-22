<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RunLogApiTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function post_app_run_log_details()
    {
        $response = $this->post('/api/log/run', $attributes = [
            'students' => '["rand@exmpl.com", "rand0@exmpl.com"]',
            'init_time' => now(),
            'status' => 1,
            'context' => null,
            'student_count' => 2,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('runs', $attributes);
    }
}
