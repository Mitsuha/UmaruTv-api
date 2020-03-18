<?php

use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$animes = App\Models\Anime::all()->pluck('id')->toArray();
    	$faker = app(Faker\Generator::class);

        foreach($animes as $anime){
            $videos = factory(App\Models\Episodes::class,5)->make()->each(function($video) use ($faker,$anime){
                $video->anime_id = $anime;
            });

            App\Models\Episodes::insert($videos->toArray());
        }
    }
}
