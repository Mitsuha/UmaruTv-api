<?php

use Illuminate\Database\Seeder;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = app(Faker\Generator::class);
    	$animes = factory(App\Models\Anime::class,20)->create()->each(function($anime){
            $anime->season_id = $anime->id;
            $anime->save();
        });

        $animes = factory(App\Models\Anime::class,30)->make()->each(function($anime) use ($animes,$faker){
        	$anime->season_id = $faker->randomElement($animes->pluck('id')->toArray());
        });

        App\Models\Anime::insert($animes->toArray());
    }
}
