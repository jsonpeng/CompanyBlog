<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('articles', function (Blueprint $table) {
                $table->increments('id'); //自增（主键）
                $table->string('title');  //文章标题
                $table->text('content');   //文章内容
                $table->bigInteger('uid');//uid与用户相关联（外键）
                $table->string('load_type');  //文章类型(原创或转载) ture=>原创 false=>转载
                $table->string('load_url');   //转载地址（原文出处）
                $table->string('cid',3000);     //cid在获取时插入所在分类关键字索引(用于搜索)
                $table->timestamp('published_at');//发布时间
                $table->bigInteger('views');
                $table->timestamps(); // 自动创建的两个字段：created_at 和 updated_at });
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
