<?php

namespace Database\Seeders;

use App\Models\Anime;
use App\Models\Episodes;
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
    	$animes = Anime::all()->pluck('id')->toArray();

        foreach($animes as $anime){
            $videos = Episodes::factory(5)->make()->each(function($video) use ($anime){
                $video->anime_id = $anime;
            });

            Episodes::query()->insert($videos->toArray());
        }
    }
}
