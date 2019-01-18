<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = App\Models\User::all()->pluck('id')->toArray();
    	$video = App\Models\video::all()->pluck('id')->toArray();
    	$faker = app(Faker\Generator::class);

        $comments = factory(App\Models\Comment::class,5000)->make()->each(function($comment) use ($faker, $user, $video){
        	$comment->user_id = $faker->randomElement($user);
        	$comment->video_id = $faker->randomElement($video);
        });

        App\Models\Comment::insert($comments->toArray());
    }
}
