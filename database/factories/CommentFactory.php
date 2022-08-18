<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CommentFactory extends Factory
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
            'content' => $this->faker->text,
            'like' => $this->faker->randomNumber(),
            'created_at' => $time,
            'updated_at' => $time,
        ];
    }
}
