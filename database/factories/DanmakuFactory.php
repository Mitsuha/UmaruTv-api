<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class DanmakuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        $time = date('Y-m-d h:i:s');

        return [
            'color' => $this->faker->hexColor,
            'text' => implode($this->faker->words(5), ' '),
            'time' => $this->randFloat(0, 10),
            'type' => random_int(0, 3),
            'created_at' => $time,
            'updated_at' => $time,
        ];
    }

    function randFloat($min = 0, $max = 1)
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }
}
