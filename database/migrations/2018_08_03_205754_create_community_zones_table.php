<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index()->comment('社区一级分类名');
            $table->text('description')->nullable()->comment('描述');
            $table->string('img_url')->default('/imgs/zone_default.jpg')->comment('分类图片');
            $table->integer('section_count')->unsigned()->default(0)->comment('二级分类数');
            $table->integer('topic_count')->unsigned()->default(0)->comment('分类下话题数');
            $table->integer('order')->default(0)->comment('排序');
            $table->string('status')->default('publish')->comment('status:{"publish":"公开","hidden":"隐藏/浏览"}');
            $table->softDeletes();
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
        Schema::dropIfExists('community_zones');
    }
}
