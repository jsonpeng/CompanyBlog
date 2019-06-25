<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_rel', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('articles_id');//文章id,与articles表的id关联
            $table->bigInteger('tag_id'); //标签id,与标签表的id关联
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
        Schema::drop('tag_rel');
    }
}
