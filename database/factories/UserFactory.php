<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'email_verified_at' => Carbon::now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'settings' => [],
            'locked' => false,
            'profile_photo_path' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ];
    }

    /**
     * Indicate that the user should have an.
     *
     * @return $this
     */
    public function withAddress()
    {
        return $this->has(
            Address::factory()
                ->state(function (array $attributes, User $user) {
                    return [
                        'line1' => '4431 Birch Street',
                        'city' => 'Greenwood',
                        'state' => 'Indiana',
                        'country' => 'United States',
                        'postal_code' => '46142',
                        'addressable_id' => $user->id,
                        'addressable_type' => get_class($user),
                    ];
                }),
            'address'
        );
    }
}
