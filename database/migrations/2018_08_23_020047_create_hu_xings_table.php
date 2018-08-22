<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuXingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hu_xings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id')->index()->comment('文章id');
            $table->string('name')->comment('upyun存储名称');
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
        Schema::dropIfExists('hu_xings');
    }
}
