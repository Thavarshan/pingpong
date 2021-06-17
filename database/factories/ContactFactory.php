<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug' => Str::slug($this->faker->unique()->userName()),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'company' => $this->faker->unique()->company(),
            'birthday' => Carbon::now()->subYears(20),
            'user_id' => create(User::class)->id,
        ];
    }
}
