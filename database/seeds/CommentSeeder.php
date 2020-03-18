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
        $user = App\Models\User::select('id')->get()->toArray();
        $video = App\Models\Episodes::select('id')->get()->toArray();
        $faker = app(Faker\Generator::class);

        $comments = factory(App\Models\Comment::class,200)->make()->each(
            function($comment) use ($faker, $user, $video){
                $comment->user_id = $faker->randomElement($user)['id'];
                $comment->episode_id = $faker->randomElement($video)['id'];
        });
        App\Models\Comment::insert($comments->toArray());
//
        $comment_ids = \App\Models\Comment::select('id')->get()->toArray();

        $comments = factory(App\Models\Comment::class,1000)->make()->each(
            function($comment) use ($faker, $user, $video, $comment_ids){
                $comment->user_id = $faker->randomElement($user)['id'];
                $comment->episode_id = $faker->randomElement($video)['id'];
                $comment->reply_id = $faker->randomElement($comment_ids)['id'];
            });
        App\Models\Comment::insert($comments->toArray());
    }
}
