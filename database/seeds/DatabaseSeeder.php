<?php

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
        switch (config('app.env')){
            case 'local':
                $this->localSeed();break;
            case 'production':
                $this->productionSeed();break;
        }
        $this->call(SettingSeeder::class);
    }

    public function localSeed(){
//        $this->call(UserSeeder::class);
//        $this->call(AnimeSeeder::class);
//        $this->call(VideoSeeder::class);
//        $this->call(ResourceSeeder::class);
//        $this->call(CommentSeeder::class);
//        $this->call(DanmakuSeeder::class);
//        $this->call(TagSeeder::class);
//        $this->call(AnimeTagSeeder::class);
    }

    public function productionSeed(){

    }
}
