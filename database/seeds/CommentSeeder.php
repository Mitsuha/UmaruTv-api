<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Episodes;
use App\Models\User;
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
        $user = User::query()->select('id')->get()->toArray();
        $video = Episodes::query()->select('id')->get()->toArray();

        $comments = Comment::factory(200)->make()->each(
            function($comment) use ($user, $video){
                $comment->user_id = fake()->randomElement($user)['id'];
                $comment->episode_id = fake()->randomElement($video)['id'];
        });
        Comment::query()->insert($comments->toArray());

        $comment_ids = Comment::select('id')->get()->toArray();

        $comments = Comment::factory(1000)->make()->each(
            function($comment) use ($user, $video, $comment_ids){
                $comment->user_id = fake()->randomElement($user)['id'];
                $comment->episode_id = fake()->randomElement($video)['id'];
                $comment->reply_id = fake()->randomElement($comment_ids)['id'];
            });
        Comment::query()->insert($comments->toArray());
    }
}
