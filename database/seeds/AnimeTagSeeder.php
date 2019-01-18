<?php

use Illuminate\Database\Seeder;

class AnimeTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = app(Faker\Generator::class);

        $animes = App\Models\Anime::select('id')->get()->pluck('id')->toArray();
        $tags = App\Models\Tag::select('id')->get()->pluck('id')->toArray();

        foreach ($animes as $aid) {
            $anime_tags = factory(App\Models\AnimeTag::class,4)->make()->each(function($ats) use ($aid, $tags, $faker){
                $ats->anime_id = $aid;
                $ats->tag_id = $faker->randomElement($tags);
            });

            App\Models\AnimeTag::insert($anime_tags->toArray());
        }
    }
}
