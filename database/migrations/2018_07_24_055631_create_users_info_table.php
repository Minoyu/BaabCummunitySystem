<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户ID');
            $table->string('avatar_url')->default('/imgs/user_default_avatar.jpg')->comment('头像地址');
            $table->string('cover_bg_url')->default('/imgs/cover_default_bg.webp')->comment('封面背景图地址');
            $table->string('motto')->nullable()->comment('格言（一句话介绍）');
            $table->integer('phone')->nullable()->comment('手机号');
            $table->string('sex')->nullable()->comment('sex:{"male":"男","female":"女"}');
            $table->string('sex_open')->default('true')->comment('open:{"true":"开放","false":"隐藏"}');
            $table->string('wechat')->nullable()->comment('微信号');
            $table->string('wechat_open')->default('false')->comment('open:{"true":"开放","false":"隐藏"}');
            $table->string('nation')->nullable()->comment('国家');
            $table->string('nation_open')->default('false')->comment('open:{"true":"开放","false":"隐藏"}');
            $table->string('living_city')->nullable()->comment('现居城市');
            $table->string('living_city_open')->default('false')->comment('open:{"true":"开放","false":"隐藏"}');
            $table->string('engaged_in')->nullable()->comment('职业/从事行业');
            $table->string('engaged_in_open')->default('false')->comment('open:{"true":"开放","false":"隐藏"}');
            $table->boolean('help_tip_open')->default(true);
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
        Schema::dropIfExists('users_info');
    }
}
