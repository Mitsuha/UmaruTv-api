<?php

use App\Models\Danmaku;
use App\Models\Episodes;
use Illuminate\Database\Seeder;

class DanmakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = App\Models\User::select('id')->get()->pluck('id')->toArray();
        $video_id = Episodes::select('id')->get()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);
        foreach ($video_id as $id) {
	        Danmaku::insert(factory(App\Models\Danmaku::class,200)->make()->each(function ($danmaku) use ($faker, $user_id, $id)
	        {
	        	$danmaku->user_id = $faker->randomElement($user_id);
	        	$danmaku->video_id = $id;
	        })->toArray());
        }

    }
}
