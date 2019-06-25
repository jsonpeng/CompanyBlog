<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//事件发生的名称
            $table->string('article_name')->nullable();//事件发生时文章的标题（用于索引）
            $table->bigInteger('article_id')->nullable();
            $table->string('category_name')->nullable();//事件发生时分类的标题(用于索引)
            $table->bigInteger('category_id')->nullable();
            $table->timestamp('start_at');//发布时间

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
