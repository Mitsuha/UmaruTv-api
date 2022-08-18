<?php

namespace Database\Seeders;

use App\Models\Tag;
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
    		Tag::factory(20)->make()->each(function ($tag){
    			$tag->type = 'style';
    		})->toArray(),
    		Tag::factory(4)->make()->each(function ($tag){
    			$tag->type = 'local';
    		})->toArray(),
    		Tag::factory(3)->make()->each(function($tag){
    			$tag->type = 'type';
    		})->toArray(),
    		Tag::factory(4)->make()->each(function($tag){
    			$tag->type = 'season';
    		})->toArray()
    	);

    	Tag::query()->insert($tags);
    }
}
