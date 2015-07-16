<?php

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
            $table->integer('usernumber')->unique();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middleinitial');
            $table->date('birthday');
            $table->string('department');
            $table->boolean('status')->default(false);
            //add roles admin officer regular
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('shifts', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->time('official_time_in');
            $table->time('official_time_out');
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('idpicture');
            $table->timestamps();
        });

        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->time('time_rendered');
            $table->string('message_logs')->nullable();;
            $table->timestamp('date_time_in');
            $table->timestamp('date_time_out')->nullable();
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
        Schema::drop('images');
        Schema::drop('shifts');
        Schema::drop('users');
        Schema::drop('attendance_logs');
    }
}
