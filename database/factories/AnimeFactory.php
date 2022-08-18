<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class AnimeFactory extends Factory
{
    static array $cover = [
        'https://pic.china-gif.com/pic/upload/vod/2018-03/152018270714.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-08/15355244040.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-10/15384496502.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-10/15388254121.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-12/15462322081.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-10/15388957632.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-10/15387952066.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-10/15387952062.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-10/15387952051.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-12/15459773296.jpg',
        'https://pic.china-gif.com/pic/upload/vod/2018-12/15459773275.jpg',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = [
            'end',
            'stop',
            'updating',
        ];
        //randomNumber() generates numbers of fixed width. To generate numbers between two boundaries, use numberBetween() instead.
        $time = $this->faker->dateTimeThisYear;
        return [
            'name' => $this->faker->name,
            'cover' => $this->faker->randomElement(static::$cover),
            'watch' => $this->faker->randomNumber(),
            'collection' => $this->faker->randomNumber(),
            'danmaku' => $this->faker->randomNumber(),
            'introduction' => $this->faker->text(),
            'release_time' => $this->faker->dateTimeThisYear,
            'episodes' => 12,
            'status' => $this->faker->randomElement($status),
            'season_name' => $this->faker->word,
            'update_time' => rand() % 7,
            'created_at' => $time,
            'updated_at' => $time
        ];
    }
}
