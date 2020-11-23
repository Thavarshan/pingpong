<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\Student;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StudentDetailsApiTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function get_student_details()
    {
        $students = Student::factory()->count(10)->create();

        $response = $this->get('/api/students');

        $response->assertStatus(200)
            ->assertJson($students->toArray());
    }
}
