<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TagFactory extends Factory
{
    static array $type = [
        'style',
        'status',
        'local',
        'type',
        'season'
    ];

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
            'type' => $this->faker->randomElement(static::$type),
            'created_at' => $time,
            'updated_at' => $time
        ];
    }
}

