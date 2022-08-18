<?php
namespace Database\Seeders;

use App\Models\Anime;
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
        $animes = Anime::factory(5)->create()->each(function($anime){
            $anime->season_id = $anime->id;
            $anime->save();
        });

        $animes = Anime::factory(30)->make()->each(function($anime) use ($animes){
        	$anime->season_id = fake()->randomElement($animes->pluck('id')->toArray());
        });

        Anime::query()->insert($animes->toArray());
    }
}
