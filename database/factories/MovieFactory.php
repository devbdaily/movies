<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'format' => $this->faker->randomElement([
                'VHS',
                'DVD',
                'Streaming',
            ]),
            'length' => $this->faker->numberBetween(0, 500),
            'release_date' => $this->faker->date(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
