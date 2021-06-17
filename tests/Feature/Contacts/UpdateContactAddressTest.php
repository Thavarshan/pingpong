<?php

namespace Tests\Feature\Contacts;

use Tests\TestCase;
use Emberfuse\Blaze\Testing\Contracts\Postable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateContactAddressTest extends TestCase implements Postable
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
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
            'line1' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
        ], $overrides);
    }
}
