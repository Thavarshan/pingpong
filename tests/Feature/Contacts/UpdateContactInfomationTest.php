<?php

namespace Tests\Feature\Contacts;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateContactInfomationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The faker user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    protected $contact;

    protected function setUp(): void
    {
        parent::setUp();

        $this->signIn($this->user = create(User::class));

        $this->contact = create(Contact::class, ['user_id' => $this->user->id]);
    }

    public function testRenderShowContactView()
    {
        $response = $this->get('/contacts/' . $this->contact->slug);

        $response->assertStatus(200);
    }

    public function testUpdateContactInformation()
    {
        $response = $this->put('/contacts/' . $this->contact->slug, $this->validParameters());

        $response->assertStatus(303);
        $response->assertSessionHasNoErrors();
    }

    public function testUpdateContactInformationThroughJson()
    {
        $response = $this->putJson('/contacts/' . $this->contact->slug, $this->validParameters());

        $response->assertStatus(200);
    }

    public function testValidNameIsRequired()
    {
        $response = $this->put('/contacts/' . $this->contact->slug, $this->validParameters([
                'name' => '',
            ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('manageContactInformation', 'name');
    }

    public function testValidEmailIsRequired()
    {
        $response = $this->put('/contacts/' . $this->contact->slug, $this->validParameters([
                'email' => '',
            ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('manageContactInformation', 'email');
    }

    public function testValidPhoneIsRequired()
    {
        $response = $this->put('/contacts/' . $this->contact->slug, $this->validParameters([
                'phone' => '',
            ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('manageContactInformation', 'phone');
    }

    public function testBirthdayIsOptional()
    {
        $response = $this->put('/contacts/' . $this->contact->slug, $this->validParameters([
                'birthday' => '',
            ]));

        $response->assertStatus(303);
        $response->assertSessionHasNoErrors();
    }

    public function testCompanyNameIsOptional()
    {
        $response = $this->put('/contacts/' . $this->contact->slug, $this->validParameters([
                'company' => '',
            ]));

        $response->assertStatus(303);
        $response->assertSessionHasNoErrors();
    }

    /**
     * Provide only the necessary paramertes for a put-able type request.
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
