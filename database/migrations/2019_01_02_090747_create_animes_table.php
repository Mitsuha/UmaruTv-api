<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->comment('名称');
            $table->string('cover')->comment('封面');
            $table->unsignedInteger('watch')->nullable()->default(0)->comment('观看人数');
            $table->unsignedInteger('collection')->nullable()->default(0)->comment('收藏订阅追番');
            $table->unsignedInteger('danmaku')->nullable()->default(0)->comment('弹幕');
            $table->text('introduction')->comment('简介');
            $table->date('release_time')->comment('发行时间');
            $table->unsignedInteger('episodes')->nullable()->default(0)->comment('有几集');
            $table->string('status',10);
            $table->unsignedInteger('update_time')->default(0)->comment('番剧更新时间');
            $table->unsignedInteger('season_id')->comment('多季情况下是第一季的 id')->default(0)->index();
            $table->string('season_name')->nullable()->comment('季度名称，如第二季、pv、剧场版');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animes');
    }
}
