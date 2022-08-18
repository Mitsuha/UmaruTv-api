<?php

namespace Database\Seeders;

use App\Models\Danmaku;
use App\Models\Episodes;
use App\Models\User;
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
        $user_id = User::query()->select('id')->get()->pluck('id')->toArray();
        $video_id = Episodes::query()->select('id')->get()->pluck('id')->toArray();

        foreach ($video_id as $id) {
	        Danmaku::insert(Danmaku::factory(200)->make()->each(function ($danmaku) use ($user_id, $id)
	        {
	        	$danmaku->user_id = fake()->randomElement($user_id);
	        	$danmaku->video_id = $id;
	        })->toArray());
        }

    }
}
