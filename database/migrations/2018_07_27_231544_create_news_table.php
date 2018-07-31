<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->text('content')->comment('内容');
            $table->string('cover_img')->nullable()->comment('封面图');
            $table->integer('user_id')->unsigned()->comment('发布者');
            $table->integer('news_category_id')->unsigned()->comment('新闻分类');
            $table->integer('replay_count')->unsigned()->default(0)->comment('回复数');
            $table->integer('view_count')->unsigned()->default(0)->comment('查看数');
            $table->integer('order')->default(0)->comment('排序');
            $table->string('status')->default('publish')->comment('status:{"publish":"公开","hidden":"隐藏/浏览"}');
            $table->timestamps();
            $table->timestamp('invalided_at')->nullable()->comment('失效时间');
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
        Schema::dropIfExists('news');
    }
}
