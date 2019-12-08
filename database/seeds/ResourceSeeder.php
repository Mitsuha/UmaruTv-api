<?php

use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $episodes = App\Models\Episodes::all()->pluck('id')->toArray();
    	$faker = app(Faker\Generator::class);

        $resource = array();

        foreach($episodes as $episode){
            $rec = factory(App\Models\Resource::class,3)->make()->each(function($resource) use ($faker,$episode){
                $resource->episode_id = $episode;
            })->toArray();

            $resource = array_merge($resource,$rec);
        }

        App\Models\Resource::insert($resource);
    }
}
