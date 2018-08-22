<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHuXingReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hu_xings', function (Blueprint $table) {
            // 当 article_id 对应的 article 表数据被删除时，删除此条数据
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hu_xings', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['article_id']);
        });
    }
}
