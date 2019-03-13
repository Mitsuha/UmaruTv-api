<?php

use Faker\Generator as Faker;

$type = [
	'style',
	'status',
	'local',
	'type',
	'season'
];

$factory->define(App\Models\Tag::class, function (Faker $faker) use ($type) {

	$time = $faker->dateTimeThisYear;
    return [
        'name'=> $faker->word,
        'type'=> $faker->randomElement($type),
        'created_at'=>$time,
        'updated_at'=>$time
    ];
});
