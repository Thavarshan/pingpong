<?php

namespace Tests\Unit\Api;

use App\Models\Run;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RunLogApiTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function post_app_run_log_details()
    {
        $this->post('/api/log/run', $attributes = [
            'students' => '["rand@exmpl.com", "rand0@exmpl.com"]',
            'init_time' => now()->format('Y-m-d H:i:s'),
            'status' => 1,
            'context' => null,
            'student_count' => 2,
        ])->assertStatus(201);

        $this->assertCount(1, Run::all());
    }
}
