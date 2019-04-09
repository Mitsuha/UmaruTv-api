<?php

use Faker\Generator as Faker;

function randFloat($min=0, $max=1){
    return $min + mt_rand()/mt_getrandmax() * ($max-$min);
}

$factory->define(App\Models\Danmaku::class, function (Faker $faker) {
	$time = date('Y-m-d h:i:s');

    return [
    	'color'=>$faker->hexColor,
    	'text'=>implode($faker->words(5), ' '),
    	'time'=>randFloat(0,10),
    	'type'=>random_int(0, 3),
    	'created_at'=>$time,
    	'updated_at'=>$time,
    ];
});
