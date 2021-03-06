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
            $table->string('name');
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('identify');
            $table->tinyInteger('sex')->default(1);
            $table->string('remake')->nullable();
            $table->integer('artisan_count')->unsigned()->default(0);
            $table->integer('notification_count')->unsigned()->default(0);
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
