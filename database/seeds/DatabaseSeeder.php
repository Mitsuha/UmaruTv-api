<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AnimeSeeder::class);
        $this->call(EpisodeSeeder::class);
        $this->call(ResourceSeeder::class);
        $this->call(CommentSeeder::class);
//        $this->call(DanmakuSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(AnimeTagSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
