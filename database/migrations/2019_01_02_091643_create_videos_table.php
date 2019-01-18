<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('anime_id')->index();
            $table->unsignedInteger('ranking')->default(1)->index()->comment('排序');
            $table->string('name');
            $table->string('info')->comment('每个视频可能有个小简介');
            $table->unsignedInteger('coin')->comment('硬币');
            $table->timestamps();

            $table->foreign('anime_id')->references('id')->on('animes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
