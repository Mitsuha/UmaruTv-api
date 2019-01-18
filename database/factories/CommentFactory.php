<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
	$time = $faker->dateTimeThisYear;
    return [
        'content'=>$faker->text,
        'like'=>$faker->randomNumber(),
        'created_at'=>$time,
        'updated_at'=>$time,
    ];
});
