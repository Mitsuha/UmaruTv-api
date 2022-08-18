<?php

namespace Database\Seeders;

use App\Models\Episodes;
use App\Models\Resource;
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
        $episodes = Episodes::all()->pluck('id')->toArray();

        $resource = array();

        foreach($episodes as $episode){
            $rec = Resource::factory(3)->make()->each(function($resource) use ($episode){
                $resource->episode_id = $episode;
            })->toArray();

            $resource = array_merge($resource,$rec);
        }

        Resource::query()->insert($resource);
    }
}
