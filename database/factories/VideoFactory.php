<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Video::class, function (Faker $faker) {
	$time = $faker->dateTimeThisYear;
    return [
        'name'=>$faker->word,
        'info'=>$faker->words(2,true),
        'coin'=>$faker->randomNumber(),
        'created_at'=>$time,
        'updated_at'=>$time
    ];
});
