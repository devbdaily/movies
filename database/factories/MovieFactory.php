<?php

namespace Database\Factories;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $releaseDate = $this->faker->dateTimeBetween('1800-01-01', '2100-01-01');
        return [
            'title' => Str::limit($this->faker->sentence(), 50, ''),
            'format' => $this->faker->randomElement([
                'VHS',
                'DVD',
                'Streaming',
            ]),
            'length' => $this->faker->numberBetween(0, 500),
            // for simplicity of testing, we're basically doing this to force
            // release dates to the same time that would get set by carbon
            'release_date' => Carbon::createFromFormat('Y-m-d', $releaseDate->format('Y-m-d')),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
