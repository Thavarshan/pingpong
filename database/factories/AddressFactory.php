<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'line1' => '4431 Birch Street',
            'city' => 'Greenwood',
            'state' => 'Indiana',
            'country' => 'United States',
            'postal_code' => '46142',
            'addressable_id' => create(User::class)->id,
            'addressable_type' => User::class,
        ];
    }
}
