<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bbs_id')->nullable()->index();
            $table->unsignedTinyInteger('sex')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar');
            $table->string('cover');
            $table->string('sign')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('ban_time')->nullable();
            $table->string('ban_reason')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
