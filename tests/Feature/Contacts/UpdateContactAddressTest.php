<?php

namespace Tests\Feature\Contacts;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Emberfuse\Blaze\Testing\Contracts\Postable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateContactAddressTest extends TestCase implements Postable
{
    use RefreshDatabase;
    use RefreshDatabase;

    /**
     * The faker user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The fake contact instance.
     *
     * @var \App\Models\Contact
     */
    protected $contact;

    protected function setUp(): void
    {
        parent::setUp();

        $this->signIn($this->user = create(User::class));

        $this->contact = create(Contact::class, ['user_id' => $this->user->id]);
    }

    public function testUpdateContactAddress()
    {
        $response = $this->from($this->contact->path)
            ->post(
                "/contacts/{$this->contact->slug}/address",
                $this->validParameters()
            );

        $response->assertStatus(303);
        $response->assertRedirect($this->contact->path);
    }

    public function testUpdateContactAddressThroughJson()
    {
        $response = $this->postJson(
            "/contacts/{$this->contact->slug}/address",
            $this->validParameters()
        );

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
