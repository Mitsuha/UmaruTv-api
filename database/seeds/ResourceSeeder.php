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
    	$videos = App\Models\Video::all()->pluck('id')->toArray();
    	$faker = app(Faker\Generator::class);

        $resource = array();

        foreach($videos as $video){
            $rec = factory(App\Models\Resource::class,3)->make()->each(function($resource) use ($faker,$video){
                $resource->video_id = $video;
            })->toArray();

            $resource = array_merge($resource,$rec);
        }

        App\Models\Resource::insert($resource);
    }
}
