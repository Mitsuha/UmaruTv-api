<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Tag::class, function (Faker $faker) {

	$time = $faker->dateTimeThisYear;
    return [
        'name'=> $faker->word,
        'created_at'=>$time,
        'updated_at'=>$time
    ];
});
