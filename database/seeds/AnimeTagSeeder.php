<?php

namespace Database\Seeders;

use App\Models\Anime;
use App\Models\AnimeTag;
use App\Models\Tag;
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
        $animes = Anime::query()->select('id')->get()->pluck('id')->toArray();
        $tags = Tag::query()->select('id')->get()->pluck('id')->toArray();

        foreach ($animes as $aid) {
            $anime_tags = AnimeTag::factory(4)->make()->each(function($ats) use ($aid, $tags){
                $ats->anime_id = $aid;
                $ats->tag_id = fake()->randomElement($tags);
            });

            AnimeTag::query()->insert($anime_tags->toArray());
        }
    }
}
