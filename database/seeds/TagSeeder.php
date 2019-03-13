<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$type = [
    		'style',
    		'local',
    		'type',
    		'season'
    	];

    	$tags = array_merge(
    		factory(App\Models\Tag::class,20)->make()->each(function ($tag){
    			$tag->type = 'style';
    		})->toArray(),
    		factory(App\Models\Tag::class,4)->make()->each(function ($tag){
    			$tag->type = 'local';
    		})->toArray(),
    		factory(App\Models\Tag::class,3)->make()->each(function($tag){
    			$tag->type = 'type';
    		})->toArray(),
    		factory(App\Models\Tag::class,4)->make()->each(function($tag){
    			$tag->type = 'season';
    		})->toArray()
    	);

    	App\Models\Tag::insert($tags);
    }
}
