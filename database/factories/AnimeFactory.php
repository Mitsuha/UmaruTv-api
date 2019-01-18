<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Anime::class, function (Faker $faker) {

    $cover = [
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

    $status = [
        'end',
        'updating.1',
        'updating.2',
        'updating.3',
        'updating.4',
        'updating.5',
        'updating.6',
        'updating.7',
        'stop.1',
        'stop.2',
        'stop.3',
        'stop.4',
        'stop.5',
        'stop.6',
        'stop.7',
    ];

	//randomNumber() generates numbers of fixed width. To generate numbers between two boundaries, use numberBetween() instead.
	$time = $faker->dateTimeThisYear;
    return [
        'name'=> $faker->name,
        'cover'=>$faker->randomElement($cover),
        'watch'=>$faker->randomNumber(),
        'collection'=>$faker->randomNumber(),
        'danmaku'=>$faker->randomNumber(),
        'introduction'=>$faker->text(),
        'release_time'=>$faker->dateTimeThisYear,
        'episodes'=> 12,
        'status'=>$faker->randomElement($status),
        'season_name'=>$faker->word,
        'created_at'=>$time,
        'updated_at'=>$time
    ];
});
