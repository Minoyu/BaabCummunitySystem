<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_carousels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cover_img');
            $table->string('title');
            $table->string('subtitle');
            $table->string('url');
            $table->string('status')->default('publish')->comment('status:{"publish":"公开","hidden":"隐藏/浏览"}');
            $table->string('position')
                ->comment('status:{"bannar":"首页轮播","headline_left":"头条左"，"headline_right":"头条右"，"info_top":"头条右"，"topic_top":"头条右"}');
            $table->integer('order')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('index_carousels');
    }
}
