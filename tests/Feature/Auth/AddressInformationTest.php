<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class AddressInformationTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testAddressInformationCanBeUpdated()
    {
        $this->signIn($user = create(User::class));

        $response = $this->put(
            '/user/profile-address',
            $this->validParameters()
        );

        $response->assertStatus(302);
        $this->assertEquals('Indiana', $user->fresh()->address['state']);
        $this->assertEquals('United States', $user->fresh()->address['country']);
    }

    public function testAddressInformationCanBeUpdatedThroughJsonRequest()
    {
        $this->signIn($user = create(User::class));

        $response = $this->putJson(
            '/user/profile-address',
            $this->validParameters()
        );

        $response->assertStatus(204);
        $this->assertEquals('Indiana', $user->fresh()->address['state']);
        $this->assertEquals('United States', $user->fresh()->address['country']);
    }

    public function validStreetNameIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put(
            '/user/profile-address',
            $this->validParameters([
                'line1' => '',
            ])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateAddressInformation', 'line1');
    }

    public function validCityIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put(
            '/user/profile-address',
            $this->validParameters([
                'city' => '',
            ])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateAddressInformation', 'city');
    }

    public function validStateIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put(
            '/user/profile-address',
            $this->validParameters([
                'state' => '',
            ])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateAddressInformation', 'state');
    }

    public function validPostalCodeIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put(
            '/user/profile-address',
            $this->validParameters([
                'postal_code' => '',
            ])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateAddressInformation', 'postal_code');
    }

    public function validCountryIsRequired()
    {
        $this->signIn(create(User::class));

        $response = $this->put(
            '/user/profile-address',
            $this->validParameters([
                'country' => '',
            ])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrorsIn('updateAddressInformation', 'country');
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
            'line1' => '4431 Birch Street',
            'city' => 'Greenwood',
            'state' => 'Indiana',
            'country' => 'United States',
            'postal_code' => '46142',
        ], $overrides);
    }
}
