<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ResourceFactory extends Factory
{
    static array $resource = [
        'https://youku.com-youku.com/20180302/ggsBONpp/index.m3u8',
        'https://youku.com-youku.com/20180304/fN7uIXL9/index.m3u8',
        'https://youku.com-youku.com/20180403/ahcpqKMu/index.m3u8',
        'https://youku.cdn1-letv.com/20180501/10429_5a3a27aa/index.m3u8',
        'https://youku.cdn1-letv.com/20180501/10422_3a29dc6d/index.m3u8',
        'https://youku.cdn1-letv.com/20180602/11818_e492583b/index.m3u8',
        'https://youku.cdn1-letv.com/20180701/12982_ab5b3956/index.m3u8',
        'https://tudou.com-v-tudou.com/20180802/14363_8d8f1c7d/index.m3u8',
        'https://tudou.com-v-tudou.com/20180901/15808_021bc3d1/index.m3u8',
        'https://tudou.com-v-tudou.com/20181001/17121_5cc4571c/index.m3u8',
        'https://tudou.com-v-tudou.com/20181101/18642_f03fcc61/index.m3u8',
        'https://pptv.com-l-pptv.com/20181201/10217_9bb41881/index.m3u8',
        'https://pptv.com-l-pptv.com/20190101/12138_8eb97d71/index.m3u8',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $time = $this->faker->dateTimeThisYear;
        $resolution = $this->faker->randomElement([[1, 4000], [2, 1080], [3, 720], [4, 370]]);

        return [
            'resource' => $this->faker->randomElement(static::$resource),
            'type' => 'm3u8',
            'resolution' => $resolution[1],
            'ranking' => $resolution[0],
            'created_at' => $time,
            'updated_at' => $time
        ];
    }
}
