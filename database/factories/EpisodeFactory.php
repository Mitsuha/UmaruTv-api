<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class EpisodeFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $time = $this->faker->dateTimeThisYear;
        return [
            'name' => $this->faker->word,
            'info' => $this->faker->words(2, true),
            'coin' => $this->faker->randomNumber(),
            'created_at' => $time,
            'updated_at' => $time
        ];
    }
}

