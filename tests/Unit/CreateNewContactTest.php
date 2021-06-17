<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use InvalidArgumentException;
use App\Actions\Contacts\CreateNewContact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Emberfuse\Scorch\Contracts\Actions\CreatesNewResources;

class CreateNewContactTest extends TestCase
{
    use RefreshDatabase;

    public function testInstantiation()
    {
        $creator = new CreateNewContact();

        $this->assertInstanceOf(CreatesNewResources::class, $creator);
    }

    public function testCreateNewContact()
    {
        $user = create(User::class);
        $creator = new CreateNewContact();
        $this->signIn($user);

        $contact = $creator->create(
            $attributes = $this->contactDetails(),
            compact('user')
        );

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertDatabaseHas('contacts', $attributes);
    }

    public function testAuthenticatedUserRequiredToCreateNewContact()
    {
        $this->expectException(InvalidArgumentException::class);

        $creator = new CreateNewContact();

        $creator->create($this->contactDetails());
    }

    /**
     * Fake contact details.
     *
     * @return array
     */
    protected function contactDetails(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'company' => $this->faker->company(),
            'email' => $this->faker->email(),
            'birthday' => Carbon::now()->subYears(20),
        ];
    }
}
