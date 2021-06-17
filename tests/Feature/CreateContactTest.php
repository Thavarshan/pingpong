<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Emberfuse\Blaze\Testing\Contracts\Postable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateContactTest extends TestCase implements Postable
{
    use RefreshDatabase;

    /**
     * The faker user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->signIn($this->user = create(User::class));
    }

    public function testRenderCreateNewContactView()
    {
        $response = $this->get('/contacts/create');

        $response->assertStatus(200);
    }

    public function testCreateNewContact()
    {
        $response = $this->from('/contacts/create')
            ->post('/contacts', $this->validParameters());

        $response->assertStatus(303);
        $response->assertSessionHasNoErrors();
    }

    public function testCreateNewContactThroughJson()
    {
        $response = $this->postJson('/contacts', $this->validParameters());

        $response->assertStatus(200);
    }

    public function testValidNameIsRequired()
    {
        $response = $this->from('/contacts/create')
            ->post('/contacts', $this->validParameters([
                'name' => '',
            ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('manageContactInformation', 'name');
    }

    public function testValidEmailIsRequired()
    {
        $response = $this->from('/contacts/create')
            ->post('/contacts', $this->validParameters([
                'email' => '',
            ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('manageContactInformation', 'email');
    }

    public function testValidPhoneIsRequired()
    {
        $response = $this->from('/contacts/create')
            ->post('/contacts', $this->validParameters([
                'phone' => '',
            ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('manageContactInformation', 'phone');
    }

    public function testBirthdayIsOptional()
    {
        $response = $this->from('/contacts/create')
            ->post('/contacts', $this->validParameters([
                'birthday' => '',
            ]));

        $response->assertStatus(303);
        $response->assertSessionHasNoErrors();
    }

    public function testCompanyNameIsOptional()
    {
        $response = $this->from('/contacts/create')
            ->post('/contacts', $this->validParameters([
                'company' => '',
            ]));

        $response->assertStatus(303);
        $response->assertSessionHasNoErrors();
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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'birthday' => Carbon::now()->subYears(20),
            'company' => $this->faker->company(),
        ], $overrides);
    }
}
