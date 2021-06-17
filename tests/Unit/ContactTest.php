<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function testBelongsToAUser()
    {
        $contact = create(Contact::class);

        $this->assertInstanceOf(User::class, $contact->user);
    }

    public function testCastsBirthdayToCarbonDate()
    {
        $contact = create(Contact::class);

        $this->assertInstanceOf(Carbon::class, $contact->birthday);
    }

    public function testHasAddress()
    {
        $contact = create(Contact::class);
        $contact->address()->create([
            'line1' => '4431 Birch Street',
            'city' => 'Greenwood',
            'state' => 'Indiana',
            'country' => 'United States',
            'postal_code' => '46142',
        ]);

        $this->assertInstanceOf(Address::class, $contact->address);
    }

    public function testRouteKeyName()
    {
        $contact = create(Contact::class);

        $this->assertEquals('slug', $contact->getRouteKeyName());
    }
}
