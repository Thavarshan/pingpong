<?php

namespace Database\Factories;

use App\Models\Run;
use Illuminate\Database\Eloquent\Factories\Factory;

class RunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Run::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $context = 'Random exception raised';

        if ($status = $this->faker->randomElement([true, false])) {
            $context = null;
        }

        return [
            'init_time' => now()->subDays(rand(0, 5)),
            'students' => [
                $this->faker->name,
                $this->faker->name,
                $this->faker->name,
            ],
            'status' => $status,
            'context' => $context,
        ];
    }
}
