<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexHeadlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_headlines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('url');
            $table->string('subUrl');
            $table->string('status')->default('publish')->comment('status:{"publish":"公开","hidden":"隐藏/浏览"}');
            $table->string('position')
                ->comment('status:{"left":"首页左侧","right":"首页右侧"}');
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
        Schema::dropIfExists('index_headlines');
    }
}
