<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            ['name' => 'default.user.avatar', 'description' => '用户默认头像', 'value' => ''],
            ['name' => 'default.user.cover', 'description' => '用户默认封面', 'value' => ''],
        ]);
    }
}
